# myITSAssistantLecturer (MIAL)
myITSAssistantLecturer is a web app to manage assistant lecturer registration and selection in the informatics department of ITS. This project is a fork from <a href="https://github.com/asteriskrin/pbkk-e-final-project">Pemrograman Berbasis Kerangka Kerja - Final Project - Team 4</a>.

## Installation
This is how to install this application.
1. Clone this repository.
2. Open folder /src and run `composer install`.
3. Copy .env.example to .env.
4. Run `docker compose up -d`.
5. Point your internet IPv4 address to domain assistantlecturer.local by using HostsMan application.
6. Enter the docker container terminal and do composer install.
7. Run these following command on the docker terminal as well.
```bash
chown -R $USER:www-data storage
chown -R $USER:www-data bootstrap/cache
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```
8. Try to access http://assistantlecturer.local on your browser to see if it is installed successfully or not.

## Reference
1. <a href="https://github.com/dptsi/laravel-web-dev">DPTSI Laravel Web Development</a>
2. <a href="https://github.com/dptsi/laravel-tutorial">DPTSI Laravel Tutorial</a>

Powered by Laravel, MySQL, Redis, and Docker.
