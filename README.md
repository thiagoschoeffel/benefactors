# Benefactors

Sistema web para gestão de benfeitores e contribuições, com geração de relatórios em PDF.

<img width="984" height="454" alt="benefactors" src="https://github.com/user-attachments/assets/d2e50036-7f27-4c59-9252-07ee73390f92" />

## 🚀 Stack

- PHP 8.4 (Laravel 11)
- Vue 3 + Inertia.js
- Tailwind CSS
- Docker & Docker Compose (execução local)
- MySQL 8.0 (via serviço do Compose)

## 📦 Rodando com Docker

### Pré-requisitos

- [Docker](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/)

### Passos rápidos

```bash
# 1) Clonar o repositório e entrar na pasta do projeto
git clone https://github.com/thiagoschoeffel/benefactors.git
cd benefactors

# 2) Copie o arquivo de ambiente e gere a APP_KEY
cp .env.example .env
php artisan key:generate

# 3) Subir os serviços (app + banco)
docker compose up -d --build
```

Quando subir, acesse:

- App: [http://localhost:8001](http://localhost:8001)
- Banco: host/porta/credenciais definidos no `docker-compose.yml`

ℹ️ Por padrão a porta configurada para o app é **8001** e o banco de dados **3306** no `docker-compose.yml`, ajuste conforme sua necessidade.

> O banco de dados é criado e populado automaticamente na primeira inicialização. Um usuário administrador é criado com as credenciais abaixo — altere após o primeiro acesso.
>
> - **E-mail:** admin@example.com
> - **Senha:** password

### Comandos úteis

Abaixo alguns comandos úteis para controlar os containers da aplicação.

```bash
# Parar
docker compose stop

# Subir novamente
docker compose up -d

# Derrubar tudo (remove os containers)
docker compose down -v
```

⚠️ Ao remover os containers com `-v` os dados do banco também são apagados. Os dados persistem enquanto o volume `mysql_data` existir.

### Estrutura

- `app/` — código da aplicação Laravel (models, controllers, etc.)
- `resources/js/` — componentes Vue 3 e páginas Inertia
- `resources/views/` — templates Blade (incluindo PDFs)
- `database/` — migrations e seeders
- `docker-compose.yml` — orquestração dos serviços (app/db)
- `Dockerfile` — imagem PHP 8.4/Apache com build do frontend

## 📄 Licença

**Sem licença (No license).**

Este repositório é disponibilizado apenas para **visualização**. **Não é permitido** usar, copiar, modificar ou distribuir o código sem autorização **por escrito** do autor.

Todos os direitos reservados.
