# sysTV
Sistema de Acompanhamento de Filmes e Seriados

## Descrição
Este sistema serve para controlar os filmes e seriados assistidos, informando qual episódio do seriado já assistiu.

## Estrutura
Projeto desenvolvido em Linux usando PHP 7.4.3 e Composer 1.10.13. Foi usado a versão 5.8 do laravel. Como banco de dados foi utilizado SQLite.

## Instalação
Baixe ou clone o projeto do git.

Na pasta do projeto execute "npm install" para baixar as dependências javascript e depois "npm run dev" para compilar essas dependências. Por ultimo execute "composer install" para instalar as dependências do php.

## Execução
Na pasta do projeto execute "php artisan serve"

(também poderá ser executado no apache desde que seja configurado um virtual host para ele).
* Foi seguido o tutorial https://www.hostinger.com.br/tutoriais/como-instalar-laravel-ubuntu/ para configurar apache com o virtual host no Ubuntu 20.04