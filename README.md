In this project admin and restaurant section are SSG and the customer section is API. 

Followings packages are used for this app:
- Breeze 
- Sanctum
- Spatie
- Mapbox

Requarements:
PHP 8.x +
Laravel 9.x +

Installation:
composer i
npm install
npm run dev
create 'snapfood' database
php artisan migrate --seed
cp .env.example .env
php artisan key:generate
php artisan storage:link
php artisan queue:work
php artisan serve

