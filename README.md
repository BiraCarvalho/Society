# README

Apesar de o Symfony oferecer um ambiente de desenvolvimento, eu preferi montar uma composição Docker. A ideia é ter um pouco mais de flexibilidade e também me "exibir" um pouquinho. =P Demorei a aderir ao Docker, mas hoje gosto bastante de trabalhar com ele e, de certo modo, me divirto criando composições.

Infelizmente, não consegui automatizar toda a instalação. Sempre acabava ocorrendo algum erro nos testes, portanto será necessário instalar as dependências antes de subir os containers e, depois, aplicar alguns comandos dentro do container para finalizar a instalação.

Minha intenção era apresentar também uma aplicação frontend em Angular e forçar o uso de HTTPS, mas como o prazo de entrega estava próximo (e já havia sido estendido uma vez, pelo que sou grato), preferi entregar o mínimo possível da melhor forma. Sei que o Symfony tem um bundle chamado API Platform, que abstrai praticamente todo o processo de construção de APIs, mas imaginei que a intenção era não usar esse tipo de suporte.

Seguem as instruções básicas para rodar este projeto:

1. Clonar o repositório
2. Instalar as dependências: na pasta `app/symfony`, instalar as dependências PHP usando `composer install`
3. Na raiz do projeto, subir a composição usando `docker compose up`
4. Acessar o container do PHP usando `docker exec -it php-desafio bash` e executar:
   1. o comando que cria as chaves criptográficas para a geração dos tokens: `bin/console lexik:jwt:generate-keypair`
   2. e o comando que executa as migrations: `bin/console doctrine:migrations:migrate`
5. Acessar a API pelo endereço https://localhost:8000

Aqui está a documentação da API: https://documenter.getpostman.com/view/1803502/2sAXxJiF78

Utilizei autenticação JWT, então será necessário gerar um novo token no Postman no endpoint http://localhost:8000/api/auth. O usuário e a senha estão na documentação, no corpo da requisição deste endpoint.

Qualquer dúvida ou problema na execução fiquem a vontade para entrar em contato comigo: birah.carvalho@gmail.com
