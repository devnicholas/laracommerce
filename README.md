# LaraCommerce
Esse projeto trata-se de uma estrutura de e-commerce utilizando o framework [Laravel](https://laravel.com), com um painel administrativo criado usando o [AdminLTE](https://github.com/jeroennoten/Laravel-AdminLTE) e integração com a API de pagamento da [Gerencianet](https://gerencianet.com.br/) para cartão de crédito e boletos. 
As funcionalidades são:
 - Comando para criação de CRUD's no admin rapidamente.
 - Estrutura para produtos simples e agrupados com atributos personalizados.
 - Cadastro de categorias e relacionamento com produtos.
 - Gerenciamento de usuários. [A FAZER]
 - Visualização de pedidos. [A FAZER]
 - Criação de promoções e cupons promocionais. [A FAZER]
 - Relatórios de faturamento, produtos mais vendidos e estoque. [A FAZER]

## Overview
### Requisitos
O projeto funciona usando o [Laravel 7.x](https://laravel.com/docs/7.x#server-requirements) que já possui seus próprios requisitos. Além deles, é necessário:
- PHP ^8.0
- Composer ^2
- NPM ^6.14
### Instalação
Para rodar a aplicação localmente, siga os passos abaixos:
1. Execute os seguintes comandos na raiz do projeto `composer install` e `npm i` para instalar as dependências.
2. Execute o comando `cp .env.example .env` para criar um arquivo de ambiente com base no exemplo. Configure as variáveis conforme o seu ambiente.
3. Execute o comando `php artisan key:generate` para gerar uma chave de criptografia na aplicação.
4. Execute o comando `php artisan link:storage` para criar um caminho publico para a pasta de uploads.
5. Execute o comando `php artisan migrate --seed` para criar a estrutura do banco de dados com o primeiro usuário cadastrado. E-mail: *admin@mail.com*; Senha: 123456.
6. Execute o comando `php artisan serve` para executar a aplicação utilizando o servidor embutido do PHP. A aplicação subirá em localhost na porta 8000.
