# README

Apesar do symfony oferecer um ambiente de desenvolvimento, eu preferi montar uma composição docker para todo o conjunto (backend e frontend).

Infelizmente não consegui automatizar toda a instalação, sempre acaba ocorrendo alguma erro, portanto será necessário instalar as dependência antes de subir o container para testar a aplicação.

Essa aqui é a documentação da API: https://documenter.getpostman.com/view/1803502/2sAXxJiF78 

1. Clonar o repositório
2. Instalar dependências das aplicações
    - O Backend está na pasta app/symfony, instalar as dependências php usando `composer install`
    - O Frontend está na pasta app/angular, instalar as dependências nodejs usando `npm install`
3. Na raiz do projeto, subir os containers usando: `docker compose up`
4. Acessar a aplicação frontend pelo endereço https://localhost:4220
5. Accesar a API pelo endereço https://localhost:8443
