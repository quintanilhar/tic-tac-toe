#!/bin/sh

BASEDIR=$(dirname "$0")

cd "${BASEDIR}/../backend"

docker-compose run --rm app ./vendor/bin/phpunit
