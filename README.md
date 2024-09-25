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
