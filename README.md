các lệnh cần chạy

//////////////////////////////////////////////////////////////////////////
sau khi clone 

1   -> composer install

2   -> npm install

3   -> cp .env.example .env
    -> chỉnh lại file .env (có thể để yên vì đã sửa)

4   -> php artisan key:generate
    -> sinh APP_KEY trong .env

5   -> chỉnh các biến trong .env
    -> DB_DATABASE,DB_USERNAME,DB_PASSWORD,....(đã để mặc định)

6   -> php artisan migrate
    -> để tạo db

7   -> php artisan db:seed
    -> tạo dữ liệu từ fake

//////////////////////////////////////////////////////////////////////////

các câu lệnh khác

composer require laravel/socialite      -> tải socialite

npm run dev                             -> cập nhật css

npm run watch                           -> theo dõi css

php artisan storage:make
php artisan storage:link
app/Console/Commands/StorageLinkCommand.php
config\filesystems.php
vendor\laravel\framework\src\Illuminate\Foundation\Console\StorageLinkCommand.php
rm public/storage
vendor\laravel\framework\src\Illuminate\Foundation\Console\ServeCommand.php
php artisan serve --port=8080
