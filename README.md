### Task Manager Service

_This is a simple task manager service built with Laravel_

### Hexlet tests and linter status:
[![Actions Status](https://github.com/Alexsey-VR/php-project-57/actions/workflows/hexlet-check.yml/badge.svg)](https://github.com/Alexsey-VR/php-project-57/actions)[![Quality gate status](https://sonarcloud.io/api/project_badges/measure?project=Alexsey-VR_php-project-57&metric=alert_status)](https://sonarcloud.io/summary/new_code?id=Alexsey-VR_php-project-57)

This a task manager project built with Laravel. It includes basic CRUD operations for tasks.

View service:
https://php-project-57-augh.onrender.com

### How to install
Install Docker on your platform
[Download Docker](https://docs.docker.com/get-started/get-docker/)

Build image: \
docker build . --tag php-project-57:v1


Define PostgreSQL connection parameters: \
export DB_CONNECTION=pgsql \
export DB_PROVIDER=postgresql \
export DB_USERNAME=... \
export DB_PASSWORD=... \
export DB_HOST=... \
export DB_PORT=... \
export DB_DATABASE=...


Run container: \
docker run -it \\ \
    -e DB_CONNECTION="${DB_CONNECTION}" \\ \
    -e DB_PROVIDER="${DB_PROVIDER}" \\ \
    -e DB_USERNAME="${DB_USERNAME}" \\ \
    -e DB_PASSWORD="${DB_PASSWORD}" \\ \
    -e DB_HOST="${DB_HOST}" \\ \
    -e DB_PORT="${DB_PORT}" \\ \
    -e DB_DATABASE="${DB_DATABASE}" \\ \
    -e PORT=8080 \\ \
    -p 8000:8000 \\ \
    php-project-57:v1


View service on localhost:8000
