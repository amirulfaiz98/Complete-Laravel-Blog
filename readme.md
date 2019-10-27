<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

## Check Version

        composer --version

        php artisan --version

        php -v

## Make Authentication

        composer require laravel/ui --dev

        php artisan ui vue --auth

        npm install

        npm run dev

## Make Migration

        php artisan make:migration create_articles_table

        php artisan migrate

        php artisan migrate:rollback

        php artisan make:migration alter_articles_table_add_user_id

## Make Controller

    php artisan make:controller ArticlesController

## Make Model

    php artisan make:model Article

## Make Factory

    php artisan make:factory ArticleFactory

## Make Seeder

    php artisan make:seeder ArticleTableSeeder

    php artisan db:seed --class=ArticleTableSeeder

## Make Request
    
    php artisan make:request StoreArticleRequest

## Make Policy

    php artisan make:policy ArticlePolicy
    
