# Modulo de Pesquisa



## Sobre <a name = "about"></a>

Projeto de uma API REST em PHP com framework Laravel, que permite criar, ler, atualizar e excluir registros em um banco de dados, front-end com Vue e Bootstrap.

![](./screen.png)

## Inicio <a name = "getting_started"></a>

Projeto desenvolvido em PHP v7.3, Laravel v8.5 e Vue v2.6

### Pré-requisito

PHP v7.3, Laravel v8.5 e Vue v2.6, composer v2.0 e node v15.0

### Instalação

- Clone o repositório com __git clone__ executando o comando:
```
git clone https://github.com/gilcleis/research-module.git
```
- Acesse o diretorio criado
- edite o arqruivo __.env.example__ para __.env__ e 

- configure as credencias de banco de dados no arquivo __.env__

- Execute o comando:

```
composer install
```
- Execute o comando:

```
php artisan key:generate
```
- Execute o comando:

```
php artisan migrate --seed
```
- Execute o comando :

```
npm install
```
- Execute o comando :

```
npm run dev
```

- Pronto, inicie o URL principal ou:
```
php artisan serve
```

