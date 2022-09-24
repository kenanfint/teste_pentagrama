
# Teste Prático Pentagrama


### Passo a passo
Clone Repositório
```sh
git clone https://github.com/kenan455/teste_pentagrama.git
```

```sh
cd teste_pentagrama/
```

Crie o Arquivo .env (linux)
```sh
cp .env.example .env
```


Atualize as variáveis de ambiente do arquivo .env
```dosini
APP_NAME=EspecializaTi
APP_URL=http://localhost:8989

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=(nome_que_desejar_db)
DB_USERNAME=root
DB_PASSWORD=root

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```


Suba os containers do projeto
```sh
docker-compose up -d
```


Acessar o container
```sh
docker-compose exec app bash
```


Instalar as dependências do projeto
```sh
composer install
```


Gerar a key do projeto Laravel
```sh
php artisan key:generate
```


Acesse o projeto
[APP_URL=http://localhost:8989](APP_URL=http://localhost:8989)
# teste_pentagrama
