#!/bin/bash

FULL_PROJECT_NETWORK=$(docker network ls | grep full-project)
if [ -z "$FULL_PROJECT_NETWORK" ]
then
    docker network create full-project --subnet=192.168.221.0/25
fi

echo "Login to dh.rinsvent.ru:"

while true; do
  docker login dh.rinsvent.ru
  if [ $? == 0 ]
     then
     break
  fi
done

# start docker containers
docker-compose up -d
