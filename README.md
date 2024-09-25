<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


# Configuração da CartMaster API 

Siga os passos abaixo para configurar corretamente a API após clonar o repositório:

1. **Instalar dependências do projeto**  
   Execute o comando abaixo para instalar todas as dependências necessárias do Laravel:
  ```bash
     composer install
  ```
Esse comando baixa e configura automaticamente todas as bibliotecas e pacotes listados no arquivo `composer.json`.

2. **Configurar variáveis de ambiente**  
   Copie o arquivo de exemplo `.env.example` para `.env` para configurar as variáveis de ambiente:
  ```bash
     cp .env.example .env
  ```
Isso criará o arquivo `.env`, onde você poderá definir as configurações do ambiente, como banco de dados, chaves de API, entre outros.

3. **Gerar a chave da aplicação**  
   Gere uma chave única para criptografia, necessária para o funcionamento seguro da aplicação:
  ```bash
     php artisan key:generate
  ```
Esse comando gera uma chave que será utilizada para proteger os dados sensíveis da aplicação.

4. **Migrar o banco de dados**  
   Execute as migrações para criar as tabelas necessárias no banco de dados:
  ```bash
     php artisan migrate
  ```
Esse comando cria a estrutura do banco de dados de acordo com os arquivos de migração definidos no projeto.

5. **Iniciar o servidor de desenvolvimento**  
   Inicie o servidor local do Laravel para rodar a aplicação:
  ```bash
     php artisan serve
  ```
Após esse comando, o servidor de desenvolvimento será iniciado, e você poderá acessar a API através do endereço `http://localhost:8000`.


# Postman Collection

Dentro deste repositório, há um arquivo de coleção do Postman (`Cart-Api.postman_collection.json`) que contém todas as requisições da API.

### Como usar:

1. **Importar para o Postman**:
   - Abra o Postman.
   - Clique em **Import** no canto superior esquerdo.
   - Selecione o arquivo `Cart-Api.postman_collection.json` disponível neste repositório.
   
2. **Explorar as Requisições**:
   - Após a importação, você terá acesso a todas as requisições já configuradas para testar a API.
   - Essas requisições incluem rotas para criar, atualizar, remover itens, entre outros recursos disponíveis na API.
