FROM yiisoftware/yii2-php:7.4-apache

ENV YII_DEBUG=false
ENV YII_ENV=prd

COPY . .

RUN composer update --prefer-dist
RUN composer install
RUN mkdir /app/runtime/cache
RUN chgrp www-data /app/web/assets
RUN chmod g+w /app/web/assets
EXPOSE 80