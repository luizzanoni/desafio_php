# DesafioPHP

Para iniciarmos, clone esse repositorio em sua máquina:
```sh
git clone https://github.com/luizzanoni/DesafioPHP.git
```

Crie o arquivo .env:
```sh
cp .env.example .env
```

Abra o docker, e acesse o container app:
```sh
docker-compose exec app bash
```

Instale as depências do projeto (composer):
```sh
composer install
```

Gere a sua key do projeto Laravel:
```sh
php artisan key:generate
```

Rode os migrations para criar as tabelas:
```sh
php artisan migrate
```


Pronto! Projeto devidamente rodando, pode acessar com 
```sh
http://localhost:8000/forecast
```

Inicialmente, a linguagem utilizada no front-end foi HTML e CSS, juntamente com Blade, próprio do PHP, para realizar as funções. As requisições foram feitas por rotas e formulários juntamente com o front-end. Para realizar as chamadas das APIs (ViaCEP e Weatherstack), utilizei JavaScript com jQuery, permitindo carregar valores de campos e aplicar a lógica de exibição de grids/campos. Para submeter as pesquisas feitas pelo usuário (método salvar), utilizei a linguagem PHP/Laravel, informando as rotas e direcionando para o controller.

Em primeiro momento, considerei a ideia de não criar migrations para rodar os bancos de dados, optando por criar os bancos diretamente com inserts e chamando os repositórios e controllers para realizar o trabalho. No entanto, acredito que a organização é melhor quando utilizamos migrations, permitindo a criação direta dos bancos de dados sem necessidade de informar os campos na entidade (Model).

Para o banco de dados, utilizei MySQL, configurado no Docker, e subi os containers para utilização do banco de dados, garantindo um código limpo e atualizado.

Apresentação do Projeto:
<p align="center">
    <img width="800" height="450" src="resources/to_readme/Animacao.gif">
</p>
