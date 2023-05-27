# install enviroment
npm i && npm run build
composer i

# create variable for enviroment
cp .env.example .env

# Artisan run
php artisan migrate
php artisan storage:link

echo 'You can `serve` to start server:'
echo ''
echo 'php artisan serve'
