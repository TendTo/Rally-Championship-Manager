# Starting from scratch: Rally Championship Manager
This will be a short tutorial on how to create the app you see in this repo starting from scratch.  
This is referred to laravel8  
**I'm not an expert in this field, so if there are some errors or inaccuracies please let me know so they can be fixed**

### Prerequisites:
-   [PHP 7.3+](https://www.php.net/downloads.php)
-   [Composer](https://getcomposer.org/download/)
-   [node.js](https://nodejs.org/en/)
-   [npm](https://www.npmjs.com/)

### Preliminary steps:
- You can make sure a compatible version of php is installed by running 
```bash
php -v
```
- If the composer's executable has been added to your path variable, make sure it is set correctly by running 
```bash
composer -v
```
- You may also need to install some additional packages:
	- `sudo apt install php-mysql` for a mysql database. Other databases need different drivers.
	- `sudo apt install php-xml`
	- `sudo apt install php-mbstring`

### :globe_with_meridians: Creating the project
Create the project with
```bash
composer create-project laravel/laravel <project-name>
```
and, once the setup has finished move in the newly created directory with 
```bash
cd <project-name>
```
Edit the _.env_ file, and personalize the settings, especially the following:
```env
DB_CONNECTION=mysql (or"pgsql" or "sqlite")
DB_HOST=127.0.0.1 (or another address or file location)
DB_PORT=3306 (or another port)
DB_DATABASE=<database_name>
DB_USERNAME=<user_name>
DB_PASSWORD=<user_password>
```
Make sure all the dependencies are installed with 
```bash
composer install
```

### :lock: Adding ui and auth scaffolding
Add the laravel/ui dependency to use the ui and auth scaffolding with
```bash
composer require laravel/ui
```
Generate the ui and auth scaffolding with 
```bash
php artisan ui bootstrap --auth
```
_(if you want more information check `php artisan ui -h`)_  
This command will generate a bunch of files in _app/http/controllers/, _resources/views/_  and _resources/sass/_, and it will modify some other files, like the _routes/wep.php_ file.  
To actually register new users, you have to migrate the user table to the database with
```bash
php artisan migrate
```
To apply the newly created scaffolding, you have to run
```bash
npm install && npm run dev
```
 and, once it completes, run 
```bash
npm run dev
```
To see the current state of the application use 
```bash
php artisan serve
```
and navigate to the address and port indicated.  
You will notice the register and login buttons in the top-right corner of the page, and you may notice they are fully functional.  

You can easily modify the style of the views by editing the _.blade.php_ filed in the _resources/views_ directory. You can also modify the user model and migration file to better fit your needs

### :memo: Adding models
To add new models, run
```bash
php artisan make:model <model-name> -r -m
```
_(you may want to use the `--all` flag to also add a factory and seeder file)_
- This command will create a Model file, a ModelController and a model migration.
	- Edit the model migration to create the table based on your needs. Remember to migrate the table once you are satisfied. |[docs](https://laravel.com/docs/8.x/migrations)|
	- You may want to add the columns names to a protected property array named _fillable_ in the Model class. |[docs](https://laravel.com/docs/8.x/eloquent)|
	- Start filling the stubs in the ModelController according to your needs. |[docs](https://laravel.com/docs/8.x/controllers#resource-controllers)|
    - If you want to protect the routes of a scecific model and allow access to them only to an authenticated users, add this contructor to the corrisponding controller
```php
public function __construct()
{
    $this->middleware('auth');
}
```
If you are unsure on what to do, you may want to check the files in the repository