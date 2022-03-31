FROM php:8.1-fpm

RUN apt-get update -y && apt-get install -y curl && apt-get clean -y

WORKDIR /app

COPY . /app/