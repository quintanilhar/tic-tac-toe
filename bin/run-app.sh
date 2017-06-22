#!/bin/sh

BASEDIR=$(dirname "$0")

cd "${BASEDIR}/../backend"

echo "Starting backend... \n\n"
docker-compose up -d

cd "../frontend"

echo "Starting frontend... \n\n"
docker-compose up -d
