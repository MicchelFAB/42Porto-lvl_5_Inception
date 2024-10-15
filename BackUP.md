Para migrar o ambiente WordPress que você criou com Docker Compose (usando containers de MariaDB, NGINX e WordPress) para outro ambiente, é necessário exportar o banco de dados e copiar os arquivos do WordPress. Aqui está o passo a passo para você realizar essa migração.
1. Preparando a Exportação do Banco de Dados

Primeiro, você precisa exportar o banco de dados do MariaDB.
Passo 1: Acesse o Container do MariaDB

    Use o seguinte comando para acessar o container do MariaDB:

    bash

    docker-compose exec mariadb bash

Passo 2: Exporte o Banco de Dados com mysqldump

    Após acessar o container do MariaDB, exporte o banco de dados para um arquivo .sql. Substitua seu_banco_de_dados, usuario_db e backup.sql pelo nome do banco de dados, o nome do usuário do banco e o nome do arquivo de backup desejado:

    bash

    mysqldump -u usuario_db -p seu_banco_de_dados > backup.sql

        O terminal solicitará a senha do banco de dados. Insira a senha e pressione Enter.
        O arquivo backup.sql estará no diretório atual do container.

Passo 3: Copie o Arquivo para a Máquina Host

    Em um novo terminal, copie o arquivo backup.sql do container para a máquina host:

    bash

    docker cp mariadb:/backup.sql /caminho/na/host/

2. Copiando os Arquivos do WordPress

    Para copiar os arquivos do WordPress, você precisa acessar o diretório onde o WordPress está sendo armazenado. Se estiver usando volumes Docker, você já terá os arquivos locais. Se não, copie os arquivos do container do WordPress para o host.

Passo 1: Verifique o Volume do WordPress

    Abra o arquivo docker-compose.yml e veja a seção do WordPress. Você verá o volume associado, algo assim:

    yaml

volumes:
  - ./wordpress_data:/var/www/html

    Se o diretório wordpress_data já existir, você pode copiar esse diretório diretamente. Se não, use o seguinte comando para copiar os arquivos do container para o host:

bash

    docker cp wordpress:/var/www/html /caminho/na/host/wordpress_data

Passo 2: Comprima o Diretório de Dados do WordPress (Opcional)

    Se desejar, você pode comprimir o diretório de arquivos do WordPress para facilitar o transporte:

    bash

    tar -czvf wordpress_data.tar.gz /caminho/na/host/wordpress_data

3. Configurando o Novo Ambiente

Agora, com os arquivos exportados (banco de dados e diretório WordPress), você pode transferi-los para o novo ambiente.
Passo 1: Transfira os Arquivos para o Novo Ambiente

    Use SCP, rsync, ou outro método de transferência para mover os arquivos para o servidor ou local de destino.

Passo 2: Extraia os Arquivos no Novo Ambiente

    No novo ambiente, extraia o arquivo de dados do WordPress (caso tenha comprimido):

    bash

    tar -xzvf wordpress_data.tar.gz -C /novo/caminho/

4. Configurando o Docker Compose no Novo Ambiente
Passo 1: Configure o docker-compose.yml

    No novo ambiente, prepare o docker-compose.yml e ajuste as configurações necessárias. Certifique-se de definir o volume do WordPress corretamente:

    yaml

    volumes:
      - /novo/caminho/wordpress_data:/var/www/html

Passo 2: Inicie os Containers

    No diretório onde o docker-compose.yml está localizado, execute:

    bash

    docker-compose up -d

5. Importando o Banco de Dados no Novo Ambiente
Passo 1: Acesse o Novo Container do MariaDB

    Entre no container MariaDB:

    bash

    docker-compose exec mariadb bash

Passo 2: Importe o Banco de Dados

    Copie o arquivo de backup para o container e use o seguinte comando para importar:

    bash

    mysql -u usuario_db -p novo_banco_de_dados < /caminho/para/backup.sql

        Insira a senha do banco de dados e o arquivo será importado para o novo banco.

6. Atualizando Configurações no WordPress

Por fim, é possível que você precise ajustar o arquivo wp-config.php e URLs no banco de dados para refletir o novo endereço IP ou domínio.
Passo 1: Edite o wp-config.php

    No diretório wordpress_data, abra o arquivo wp-config.php e ajuste as configurações de conexão do banco de dados, se necessário:

    php

    define('DB_NAME', 'novo_banco_de_dados');
    define('DB_USER', 'usuario_db');
    define('DB_PASSWORD', 'sua_senha');
    define('DB_HOST', 'mariadb'); // Ou o IP, se o banco estiver em outro host

Passo 2: Ajuste as URLs no Banco de Dados

    No container MariaDB, você pode ajustar as URLs no banco:

    sql

    UPDATE wp_options SET option_value = 'http://seu-novo-dominio-ou-ip' WHERE option_name = 'siteurl' OR option_name = 'home';

Agora, você terá migrado seu WordPress para um novo ambiente, mantendo o banco de dados e os arquivos necessários.