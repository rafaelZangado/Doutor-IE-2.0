<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## PROJETO

Este projeto utiliza o framework Laravel para gerenciar livros e índices através de uma API RESTful. 
Abaixo estão os principais componentes e funcionalidades implementadas:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Modelos
- **[Livro]: Gerencia informações sobre livros, incluindo título e relacionamentos.**
- **[Indice]: Gerencia índices associados aos livros, com título, página e relacionamentos hierárquicos.**

## 🚀 Controladores
## 🚀 Repositórios 
## 🚀 Serviços
## 🧪 Testes Unitários:


As rotas da API:

- **[POST]** v1/auth/token: Recuperar token de acesso do usuário para poder acessar as outras rotas

**Livros:**
- **[GET]** v1/livros: Listar livros
- **[POST]** v1/livros: Cadastrar livro.
- **[PUT]** v1/livros/{livro}: Atualizar livro.
- **[DELETE]** v1/livros/destroy/{livro}: Deletar livro.

**Índice:**
- **[POST]** v1/indices: Cadastrar Indices.
- **[PUT]** v1/indices/{id}: Atualizar Indices.
- **[DELETE]** v1/indices/destroy/{id}: Deletar Indices.

- **[POST]** v1/livros/{livroId}/importar-indices-xml: Importar índices em xml
