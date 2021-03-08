FROM yiisoftware/yii2-php:7.4-apache

WORKDIR /app
ENV YII_DEBUG=false
ENV YII_ENV=prd

COPY . .

RUN composer update --prefer-dist
RUN composer install