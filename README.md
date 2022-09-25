<h1 align="center" class="line-1 anim-typewriter">Teste Prático Pentagrama</h1>


<h2 id="built_with">📝 Como rodar o projeto localmente:</h2>


Clone o repositório:
```sh
git clone https://github.com/kenan455/teste_pentagrama.git
```

Entre no projeto:
```sh
cd teste_pentagrama/
```

Crie o Arquivo .env (comando do linux):
```sh
cp .env.example .env
```


Atualize as seguintes variáveis de ambiente do arquivo .env (muito importante)
```dosini
APP_URL=http://localhost:8989

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=(nome_que_desejar_db)
DB_USERNAME=(username_que_desejar_db)
DB_PASSWORD=(senha_que_desejar_db)

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_HOST=redis
```


Suba os containers do projeto:
```sh
docker-compose up -d  # ou docker compose up -d 
```


Acessar o container:
```sh
docker-compose exec app bash  # ou docker compose exec app bash 
```


Instalar as dependências do projeto:
```sh
composer install
```


Gerar a key do projeto Laravel:
```sh
php artisan key:generate
```

Adicione migrations no banco:
```sh
php artisan migrate
```

Faça o seed do banco:
```sh
php artisan db:seed
```


Acesse o projeto na url abaixo:</br></br>
APP_URL=http://localhost:8989

# Testes

<img src="https://i.imgur.com/I9qbvya.png"/>

# Preview

<img src="https://i.imgur.com/szlqyj2.png" alt="login">

<img src="https://i.imgur.com/5VnKpCj.png" alt="signup">

<img src="https://i.imgur.com/hGmIHeR.png" alt="main-table">

<img src="https://i.imgur.com/WIbCUfD.png" alt="create-table">

<h2 id="built_with">👷‍♂️ Ferramentas utilizadas</h2>

-  <img width="30" height="30" src="https://laravel.com/img/logomark.min.svg"/> Laravel;
-  <img width="30" height="30" src="https://cdn-icons-png.flaticon.com/512/5968/5968672.png"/> Bootstrap;

<h2 id="the_challenge"> 🌋 O teste</h2>

Esta é a solução do teste proposto pela [pentagrama](https://www.pentagrama.com.br/).

Requisitos obrigatórios:
  - [x] Tela de login;
  - [x] Tela de cadastro de cidade (nome da cidade, estado e data de fundação);
  - [x] Tela de cadastro de bairro (apenas nome),associando a uma cidade (se preferir, poderá ser feita em uma única tela os cadastros de cidade e de bairro);
  - [x] Relatório de cidades e bairro (filtrar por nome da cidade, data da fundação e nome do bairro;
  - [x] Tela de cadastro de usuário;
 
 <h2 id="author">👨‍🎓 Autor </h2>

- Nome: Kenan Fintelman
- E-mail: kenanfintelman123@hotmail.com

