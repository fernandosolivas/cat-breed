FROM yiisoftware/yii2-php:7.4-apache

ENV YII_DEBUG=false
ENV YII_ENV=prd

COPY . .

RUN chown -R 777 root:root /app/
RUN composer update --prefer-dist
RUN composer install

EXPOSE 80