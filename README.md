# Teste Programador PHP Back-end Pleno

sistema de produtos com *variações de cores*

## Clone

```
git clone https://github.com/timoteo7/backend-challenge.git
```

## Install

```sh
composer install
```
em seu arquivo `.env` defina os dados do teu banco de dados: 
DB_DATABASE, DB_USERNAME, DB_PASSWORD

## Usage

```sh
php artisan migrate:fresh --seed
php -S localhost:8000 -t public
```

## Setup (Optional)

Se não quiser usar o Servidor web embutido do PHP e já tiver um servidor Apache (http://localhost/backend-challenge/)

```
sudo chmod -R 777 storage/framework storage/logs
```


## ToDo

- [  ] Cadastro de usuários (atualização e remoção ?)
- [  ] Autenticação utilizando JWT
- [  ] Crud de produtos
- [  ] Relação com Variação de Cores
- [  ] Documentar com MarkDown (README.md)
- [  ] Diagrama dos endpoints
- [  ] Faker para o Factory & Seed
- [  ] TDD


## Script History

```
composer create-project laravel/lumen backend-challenge && cd backend-challenge
git init && git add . && git commit -m 'Lumen'
wget https://raw.githubusercontent.com/timoteo7/files/master/.htaccess
wget https://raw.githubusercontent.com/Scalingo/sample-php-lumen/master/server.php
```

```
composer require laracasts/generators --dev
sed -i "/AppServiceProvider/ s/\/\/ //" bootstrap/app.php
sed -i "N;/{\n\s*\/\//a \\\t\tif (\$this->app->environment() == 'local') {\n\t\t\t\$this->app->register('Laracasts\\\Generators\\\GeneratorsServiceProvider');\n\t\t}" app/Providers/AppServiceProvider.php
                 s="name:";            s+="string(190), ";\
                s+="email:";           s+="string(150):unique, ";\
                s+="password:";        s+="string(190):nullable ";\
php artisan make:migration:schema create_users_table --schema="$s" --model=0
php artisan migrate
```

```
composer require irazasyed/larasupport
composer require reliese/laravel --dev
mkdir config 2>/dev/null
cp vendor/reliese/laravel/config/models.php config/models.php
sed -i "s/app_path('Models')/base_path('app\/Models')/" config/models.php
sed -i "/app->configure('app');/a \\\$app->configure('models');" bootstrap/app.php
sed -i "N;/{\n\s*\/\//a \\\t\tif (\$this->app->environment() == 'local') {\n\t\t\t\$this->app->register(\\\Reliese\\\Coders\\\CodersServiceProvider::class);\n\t\t}" app/Providers/AppServiceProvider.php
php artisan code:models
```


## Topics (tags)
##### #Product  #Colors

## Author

👤 **[Timóteo](https://timoteo7.github.io/)**



## Built With

* [Lumen](https://github.com/laravel/lumen) - The stunningly fast micro-framework by Laravel.
* [Laravel-Generators-Extended](https://github.com/laracasts/Laravel-5-Generators-Extended) - Extends the core file generators.
* [Reliese Laravel](https://github.com/reliese/laravel) - Collection of Components for code generation.


## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
