# Schedule Uz
##### This is a project built using the Laravel 9 PHP framework. The main goal of the project is to provide an easy way to schedule.


## Installation
1. Clone the repository: `git clone https://github.com/firefoxuz/schedule_uz.git`
2. Navigate to the project directory: `cd schedule_uz/src`
3. Install the dependencies:
4. `composer install`
5. `npm install`
6. Create a copy of the .env file: `cp .env.example .env`
7. Generate an application key: `php artisan key:generate`
8. Set up the database connection in the .env file
9. Run the migration: `php artisan migrate`
10. Run the seed command: `php artisan db:seed`
11. Build the assets: `npm run dev` or `npm run production`
12. Start the development server: `php artisan serve`
13. The application will be available at http://localhost:8000.

## Installation using docker
1. Clone the repository: `git clone https://github.com/firefoxuz/schedule_uz.git`
2. Navigate to the project directory: `cd schedule_uz`
3. Create a copy of the .env file: `cp src/.env.example src/.env`
4. `docker-compose up -d --build` to build docker container
5. Install the dependencies:
6. `docker-compose run --rm composer install`
7. Key generate `docker-compose run --rm artisan key:generate`
8. Migrating `docker-compose run --rm artisan migrate`
9. Seeding `docker-compose run --rm artisan db:seed`
10. Creating new user `docker-compose run --rm artisan user:create admin@admin.com 123456`

## Usage
This project can be used as a starting point for any web application built with Laravel 9.

## Contribution
Fork the repository
Create a new branch for your feature (git checkout -b my-feature)
Make the necessary changes and commit (git commit -am 'added my feature')
Push to the branch (git push origin my-feature)
Create a new Pull Request
## Support
If you have any questions or issues, please feel free to contact me at daler.sultonov.00@gmail.com
