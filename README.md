                Web
            ----------
1. Using technology : Laravel 11
2. Application Run By - php artisan serve
3. create a user by click 'add user' button in dashboard.
4. Then click 'user login' button  for login user.
5. Enter Email & password to login.
6. after login page redirect to user dashboard.
7. newly created user must change their password before accessing any other protected endpoints.

Using Command :
for creating Controller

php artisan make:controller DashboardController
php artisan make:controller UserController

after adding two column(password_changes_status,password_updated_at) into user table

php artisan migrate:roleback
php artisan migrate


                    Api
                ------------
1. install api to laravel project By - php artisan install:api
2. For API Token Authentication use Sanctum.
3.