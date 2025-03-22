# Task Management App

## Introduction
A simple task management app.

## Installation
- Create database with the name of `taskapp`


```sh
git clone https://github.com/mustabshirkhan/taskApp.git
cd taskApp
composer install
cp .env.example .env
```
- Enter DB credentials in .env
```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=taskApp
DB_USERNAME=root
DB_PASSWORD=<password>
```
- Enter SMTP configurations
```angular2html
MAIL_MAILER=smtp
MAIL_HOST="<your smtp host>"
MAIL_PORT=425
MAIL_USERNAME=username
MAIL_PASSWORD=password
```
- Run the following commands
```sh
php artisan key:generate
php artisan migrate --seed
php artisan passport:install
php artisan serve
```

## API Endpoints
### Authentication
- `POST /api/v1/register` - Register a new user
- `POST /api/v1/login` - Login user
- `POST /api/v1/logout` - Logout user
- `GET /api/v1/user` - Get authenticated user info

### Tasks
- `GET /api/v1/tasks` - List all tasks
- `POST /api/v1/tasks` - Create a new task
- `GET /api/v1/tasks/{task}` - Get a task
- `PATCH /api/v1/tasks/{task}` - Update a task
- `DELETE /api/v1/tasks/{task}` - Delete a task

### Comments
- `POST /api/v1/tasks/{task}/comments` - Add a comment to a task
- `PATCH /api/v1/comments/{comment}` - Update a comment

## Queue & Scheduler
```Crontab Setup```
- `Open terminal and run following commands`
```
1. sudo -i
2. crontab -e
3. * * * * * php /var/www/html/taskApp/artisan schedule:run >> /dev/null 2>&1
```


## Debugging
```sh
php artisan config:clear
php artisan cache:clear
php artisan queue:restart
php artisan queue:failed
php artisan queue:retry all
```

## License
MIT License

## Contributing
Pull requests are welcome!

## Support
Open an issue on GitHub if you need help.

🚀 Happy Coding! 🎉

