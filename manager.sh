#!/bin/bash

COMMAND=$1
ENVIRONMENT=$2
shift 2

if [ -z "$ENVIRONMENT" ]
then
    echo "No environment specified. Defaulting to localhost."
    ENVIRONMENT=localhost
fi

if [ "$COMMAND" = "test" ]
then
    echo "Running tests ..."
    docker compose --env-file .env.localhost -f docker-compose.yaml.localhost exec php bash -c "php artisan db:refresh_test && APP_ENV=testing php artisan db:seed && ./vendor/bin/pest $*"
elif [ "$COMMAND" = "build" ]
then
    echo "Building docker containers for $ENVIRONMENT..."
    docker compose --env-file .env.$ENVIRONMENT -f docker-compose.yaml.$ENVIRONMENT build
elif [ "$COMMAND" = "start" ]
then
    echo "Starting docker containers for $ENVIRONMENT..."
    docker compose --env-file .env.$ENVIRONMENT -f docker-compose.yaml.$ENVIRONMENT up -d
elif [ "$COMMAND" = "stop" ]
then
    echo "Stopping docker containers for $ENVIRONMENT..."
    docker compose --env-file .env.$ENVIRONMENT -f docker-compose.yaml.$ENVIRONMENT stop
elif [ "$COMMAND" = "bash" ]
then
    echo "Entering docker php for $ENVIRONMENT..."
    if [ $# -eq 0 ]
    then
        docker compose --env-file .env.$ENVIRONMENT -f docker-compose.yaml.$ENVIRONMENT exec php bash
    else
        docker compose --env-file .env.$ENVIRONMENT -f docker-compose.yaml.$ENVIRONMENT exec php bash -c "$*"
    fi
else
    echo "Invalid command. Valid commands are build, start, stop or bash"
fi
