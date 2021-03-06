FROM yiisoftware/yii2-php:7.4-apache
ARG CAT_API_KEY
ARG REDIS_URL

ENV YII_DEBUG=false
ENV YII_ENV=prd
ENV CAT_API_KEY=$CAT_API_KEY
ENV REDIS_URL=$REDIS_URL
COPY . .

RUN composer update --prefer-dist
RUN composer install
RUN mkdir /app/runtime/cache
RUN chgrp www-data /app/web/assets
RUN chmod g+w /app/web/assets
EXPOSE 80