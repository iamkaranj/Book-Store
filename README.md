
# Book Store

This project is a functioning online bookstore The primary goal of this project is to provide users with the ability to search for books by title and view detailed information about a selected book.

    

## Deployment

- Create a table in Database and setup in .env

```bash
DB_HOST = localhost
DB_DATABASE = packt-laravel
DB_USERNAME = root 
DB_PASSWORD = 123
```

- Copy env.example to .env and update accordingly,
- also make sure to enable meilisearch and provide valid host port details in .env.
-Run these commands.

```bash
- composer install
- npm i 
- npm run dev
- php artisan migrate
- php artisan db:seed
- php artisan storage:link
- php artisan scout:sync-index-settings
- php artisan serve
```


## Credentials

Please use this URL and Credentials for Admin Login 

```bash
  Email : admin@gmail.com
  Password: password
  url: http://127.0.0.1:8000/admin/login
```

## Authors

- [@karanjadav](https://www.linkedin.com/in/karan-jadav-web-developer/)

