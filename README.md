1 - docker compose up -d --build

2 - docker exec -it url_shortener_app bash
3 - composer install
4 - php artisan key:generate
5 - php artisan migrate
6 - exit

7 - docker exec -it url_shortener_node bash
8 - npm install
9 - npm run build
