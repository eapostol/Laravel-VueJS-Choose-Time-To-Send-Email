# Clublink - Mail Scheduler - Test

Version 0.05

## Instructions

1. Clone the project

2. Run: `composer install`

3. Edit the .env file to add mailtrap / sendgrid settings .Edit config/Mail.php for similar settings.

4. Create a database with the name used in .env

5. Run: `php artisan key:generate`
   
6. Run: `php artisan config:cache`

7. Run: `php artisan migrate:fresh --seed`

8. Run: `npm install`

9. Run: `php artisan serve` (not needed if you set up homestead)
