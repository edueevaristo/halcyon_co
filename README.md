# Glittr

Glittr é uma plataforma focada em **comparação e descoberta de produtos de beleza**, ajudando usuários a tomarem decisões de compra mais inteligentes com base em informações claras e organizadas.

## Sobre o projeto

A proposta do Glittr é simplificar a jornada de compra, reunindo produtos, atributos e comparativos em um só lugar, com foco em usabilidade, performance e escalabilidade.

## Funcionalidades

- Busca e descoberta de produtos de beleza  
- Comparação entre produtos  
- Interface moderna e responsiva  
- Arquitetura preparada para escalar  

## Stack utilizada

### Backend
- PHP 8  
- Laravel 10  
- MySQL  
- Docker  

### Frontend
- Vue.js 3  
- HTML  
- CSS  

### Infraestrutura / Deploy
- AWS  
- Hostinger  
- Render  

## Arquitetura

- Backend desacoplado via API  
- Frontend em SPA com Vue.js  
- Containers Docker para padronização do ambiente  
- Banco de dados relacional com MySQL  

## Como rodar o projeto (resumo)

```bash
# Clone o repositório
git clone https://github.com/seu-usuario/glittr.git

# Suba os containers
docker-compose up -d

# Instale dependências do backend
composer install

# Execute as migrations
php artisan migrate
