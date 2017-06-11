Atividades
=======================

Introdução
------------
Este é um projeto criado para o teste de Analista Programador da DuoSystem.

Instalação - Composer
---------------------------

Após clonar/baixar o o projeto, instale o [Composer](https://getcomposer.org/).


Instale as dependências:

    composer install


Setup Banco de dados
---------------------

Script para criação das tabelas está em src/database.sql . O modelo de dados está no mesmo diretório.
Configure as informações de conexão no arquivo /config/autoload/global.php ou (recomendado) crie um arquivo local.php em /config/autoload/ usando o global.php como base.

Web server setup
----------------

### PHP CLI server

A maneira mais simples de iniciar se você estiver usando o PHP 5.4 ou acima é iniciar o PHP Cli-server no diretório root:

    php -S localhost:8080 -t public/ public/index.php


### Vagrant server

Este projeto suporta uma configuração [Vagrant](http://docs.vagrantup.com/v2/getting-started/index.html) para rodar em um [VirtualBox](https://www.virtualbox.org/wiki/Downloads).

1. Rode o comando vagrant up

    vagrant up

2. Visite [http://localhost:8085](http://localhost:8085) no browser

Verifique [Vagrantfile](Vagrantfile) para detalhes de configuração.

### Apache setup

Para configurar o apache, configure um host virtual para apontar para o diretório public/ . Exemplo: 

    <VirtualHost *:80>
        ServerName zf2-app.localhost
        DocumentRoot /path/to/zf2-app/public
        <Directory /path/to/zf2-app/public>
            DirectoryIndex index.php
            AllowOverride All
            Order allow,deny
            Allow from all
            <IfModule mod_authz_core.c>
            Require all granted
            </IfModule>
        </Directory>
    </VirtualHost>