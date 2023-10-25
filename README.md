<h3>News test task</h2>

1) Build the project: ``make build``

2) if doesn't have ``make`` do plain docker-compose commands
```
cp .env.local .env
docker-compose build
docker-compose up -d  
docker-compose run composer composer install
docker-compose exec php php artisan migrate:fresh --seed
docker-compose run --user node front npm install
docker-compose run --user node front npm run build 
docker-compose exec php php artisan test
```

3) open <a>http://localhost</a>
