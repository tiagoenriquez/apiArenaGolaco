## <h1 align=center><b>API ARENA GOLAÇO</b></h1>

Api para persistência de dados provenientes do aplicativo Arena Golaço, uma quadra fictícia criada para ser objeto do presente projeto.

## Como ter esta API rodando na sua máquina:

Clone este projeto: git clone https://github.com/tiagoenriquez/apiArenaGolaco.git <br>
Instale as dependências do laravel: composer install <br>
Insira as informações de nome de banco de senha no .env <br>
Crie um banco no MySql com o nome inserido no .env <br>
Migre as tabelas para a base de dados: php artisan migrate <br>
Inicie o Apache
Suba a API: php artisan serve
Acesse o sistema pela URL http://localhost:8000/api

## Requisitos do sistema:

Composer version 1.10.13 <br>
Laravel Installer 4.0.5 <br>
PHP 7.4.10

## Ações desta API:

1. Cadastro de usuário: <br>
    -> URL: /usuario    <br>
    -> Verbo: post <br>
    -> Argumentos: 
        nome (body), 
        cpf (body), 
        telefone (body), 
        email (body), 
        senha (body), 
        senhaConfirmacao (body) <br>
    -> Retorno: 
        Mensagem de sucesso <br>

2. Login: <br>
     -> URL: /login <br>
    -> Verbo: post <br>
    -> Argumentos: 
        email (body), 
        senha (body) <br>
    -> Retorno: 
        usuario (id, nome, cpf, telefone, email, senha (criptografada)) <br>

3. Cadastro de reserva: <br>
    -> URL: /reserva <br>
    -> Verbo: post <br>
    -> Argumentos: 
        inicio (body), 
        usuario_id (body) <br>
    -> Retorno: 
        -> Mensagem de sucesso <br>

4. Listagem de reservas por data: <br>
    -> URL: /reserva/data={data} <br>
    -> Verbo: get <br>
    -> Argumentos: 
        data: (route) <br>
    -> Retorno: 
        Lista de reservas (inicio, fim, usuario) <br>

5. Listagem de reservas por usuário: <br>
    -> URL: reserva/usuario={usuario}&inicio={inicio} <br>
    -> Verbo: get <br>
    -> Argumentos: 
        usuario (route), 
        inicio (route) <br>
    -> Retorno: 
        Lista de reservas (inicio, fim) <br>

6. Exclusão de reserva: <br>
    -> URL: /reserva <br>
    -> Verbo: delete <br>
    -> Argumentos: 
        inicio (route) <br>
    -> Retorno: 
        Mensagem de sucesso <br>

## Autores:

Tiago Enriquez Tachy <br>
Ian Vitor

## Framework:

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
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

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
