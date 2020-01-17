# README
# laracomptability

## Init BACK 

- Clone the repository with __git clone__
- Copy __.env.example__ file to __.env__ and edit database credentials there
- Run __docker-compose up__
- Run __docker-compose exec php composer install__
- Run __docker-compose exec php php artisan migrate__
- Run __docker-compose exec php php artisan key:generate__
- Run __docker-compose exec php php artisan migrate --seed__ 

## init FRONT

- Run __npm install__
- Run __npm start__

