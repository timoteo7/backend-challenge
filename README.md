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

- [x] ~~Cadastro de usuários~~ (atualização e remoção ?)
- [x] ~~Autenticação utilizando JWT~~
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

```
composer require tymon/jwt-auth
sed -i "/AuthServiceProvider/ s/\/\/ //" bootstrap/app.php
sed -i "/EventServiceProvider/a \\\$app->register(Tymon\\\JWTAuth\\\Providers\\\LumenServiceProvider::class);" bootstrap/app.php
sed -i "1N;$!N; s/\/\/ \(\$app->routeMiddleware.*\n\)\/\/ \(\s*'auth'.*\n\)\/\/ /\1\2/;P;D" bootstrap/app.php
php artisan jwt:secret
sed -i "/app->withFacades();/ s/\/\/ //" bootstrap/app.php
sed -i "/app->withEloquent();/ s/\/\/ //" bootstrap/app.php
wget -P config https://gist.githubusercontent.com/mabasic/7979d67ce3ec75a5938e3d14575736a6/raw/61d1e5d49a450c3aae2289ef4c55c900e99180b6/auth.php
wget -P app/Http/Controllers https://raw.githubusercontent.com/buzdyk/Lumen/master/app/Http/Controllers/AuthController.php
sed -i "N;/router->app->version();\n});/a \\\n\$router->group(['prefix' => 'api'], function () use (\$router) {\n\t\$router->post('user', 'AuthController@register');\n\t\$router->post('login', 'AuthController@login');\n});" routes/web.php
```

```
                 s="codigo:";           s+="string(60):nullable, ";\
                s+="descricao:";        s+="text, ";\
                s+="unidade:";          s+="string(50):nullable, ";\
                s+="valor:";            s+="decimal(15,2), ";\
                s+="sku:";              s+="string(100):nullable, ";\
                s+="codFiscal:";        s+="string(60):nullable, ";\
                s+="NCM:";              s+="string(30):nullable, ";\
                s+="pesoLiquido:";      s+="unsignedInteger:nullable, ";\
                s+="tamanho:";          s+="string(30):nullable, ";\
                s+="material:";         s+="string(50):nullable, ";\
                s+="categoria:";        s+="string(50):nullable, ";\
                s+="caracteristica:";   s+="text:nullable, ";\
                s+="fabricante:";       s+="string(190):nullable, ";\
                s+="urlImagem:";        s+="string(190):nullable, ";\
                s+="estoqueMinimo:";    s+="unsignedInteger:nullable ";\
php artisan make:migration:schema create_products_table --schema="$s" --model=0
php artisan migrate
php artisan code:models
```

```
                 s="cor:";          s+="string(100),";\
                s+="product_id:";   s+="unsignedInteger:foreign";\
php artisan make:migration:schema create_variations_table --schema="$s" --model=0
php artisan migrate
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
* [JWT-Auth](https://github.com/tymondesigns/jwt-auth) - JSON Web Token Authentication.


## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
