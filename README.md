## 環境需求

1. Docker

## 安裝流程

1. `git clone [xxx](https://github.com/asdcxz179/laravel-docker.git)`
2. `cd laravel-docker`
3. `cp ./php/config/php.ini.example ./php/config/php.ini`
4. `vi ./php/config/php.ini 設定 php-error.log 位置`
5. `cp ./db/password.txt.example ./db/password.txt`
6. `vi ./db/password.txt 設定 mysql資料庫密碼`
7. `cp ./redis/.env.example ./redis/.env`
8. `vi ./redis/.env 設定 redis資料庫密碼`
10. `cp .env.example .env`
11. `vi .env` 修改為本地 DB 連線
12. `docker-compose up -d`
13. `docker exec admin-php php artisan key:generate`
14. `docker exec admin-php php artisan storage:link`
15. `docker exec admin-php php artisan migrate`
16. `docker exec admin-php php artisan db:seed`
17. `docker exec admin-php php artisan instal:api`
18. `chmod -R 775 storage;chown -R www-data:www-data storage;`
19. `打開網址 [http://localhost:8081](http://localhost:8081)`
