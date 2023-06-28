cp /home/site/wwwroot/default /etc/nginx/sites-available/default
service nginx reload

cd /home/site/wwwroot && cp -n .env.example. env
php artisan key:generate
