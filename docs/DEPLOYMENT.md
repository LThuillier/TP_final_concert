# Deploiement

## Docker Local
```bash
docker compose up -d --build
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate --seed
```

Application: `http://localhost:8000`

## CI/CD Bitbucket
Le pipeline (`bitbucket-pipelines.yml`) execute:
1. Installation PHP/Node + extensions.
2. `composer install`
3. `php artisan migrate`
4. `npm run build`
5. `php artisan test`
