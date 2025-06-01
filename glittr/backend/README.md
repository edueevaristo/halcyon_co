### Passo a passo

Suba os containers do projeto
```sh
docker-compose up -d
```

Acesse o container app
```sh
docker-compose exec app bash
```

Instale as dependências do projeto
```sh
composer install
```

Gere a key do projeto Laravel
```sh
php artisan key:generate
```

Rodar as migrations
```sh
php artisan migrate
```

Para ativar a linkagem das imagens (obrigatório para o front-end)
```sh
php artisan storage:link
```

Inicie o servidor
```sh
php artisan serve
```


Para casos de erros com o redis no Dockerfile, remova o comando abaixo no Dockerfile
```sh
RUN docker-php-ext-enable redis
```

Acesse o projeto
[http://localhost:8000](http://localhost:8000)
