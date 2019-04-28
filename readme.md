## Formulário de contato Laravel

Um formulário de contato desenvolvido com Laravel

## Instruções
Necessário instalar composer
(https://getcomposer.org/download/)

### Instalação: ###
* `git clone https://github.com/ndrvieira/contact_form.git nomedoprojeto`
* `cd nomedoprojeto`
* `composer install`
* `php artisan key:generate`
* `configurar .env na raiz do projeto`

### Configuração do email (`.env`): ###
* `MAIL_DRIVER=smtp` //driver, por padrão utilizaremos smtp
* `MAIL_HOST=mail.fireservers.com.br` //endereço do seu host de email
* `MAIL_PORT=465` //porta de conexão com o smtp, padrão: 465 (ssl) 587 (sem ssl)
* `MAIL_USERNAME=teste@fireservers.com.br` //seu email, endereço para o qual será enviado
* `MAIL_PASSWORD=senha` //senha do seu email
* `MAIL_ENCRYPTION=ssl` //null ou ssl
* `MAIL_SUBJECT="Mensagem recebida!"` //Assunto do email que será enviado
* `MAIL_NAME="Laravel Email"` //Nome de email a ser exibido
* `MAIL_ADDR=teste@fireservers.com.br` //Endereço de email a ser exibido

### Conexão com o banco de dados (`.env`) ###
* `DB_CONNECTION=mysql`
* `DB_HOST=127.0.0.1`
* `DB_PORT=3306`
* `DB_DATABASE=database`
* `DB_USERNAME=login`
* `DB_PASSWORD=senha`

### Após configurar o banco de dados, rodar no console ###
* `php artisan migrate --path=/database/migrations/2019_04_25_005908_create_contatos_table.php`

## License

This is a open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
