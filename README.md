<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://cdn.prod.website-files.com/618d2912818669913e63c92e/67470484af7d1a877cca7a7a_MelhorEnvio_Bicolor_Positivo-p-1600.png" width="400" alt="Laravel Logo"></a></p>


# Teste Analista de Desenvolvimento Júnior - Backend

## Sobre o teste

- Processar o arquivo de log, extrair informações e salvá-las no banco de dados.
- Gerar um relatório para cada descrição abaixo, em formato csv:
    - Requisições por consumidor;
    - Requisições por serviço;
    - Tempo médio de **`request`**, **`proxy`** e **`gateway`** por serviço.
- Documentar, em um arquivo **`README.md`**, o passo a passo para executar o teste, incluindo como configurar o ambiente e executar a solução.
- Garantir que o teste seja entregue em um ambiente Docker, facilitando a configuração e execução.
- Efetuar commits frequentes que representem as etapas do desenvolvimento, utilizando um repositório git público.
- Disponibilizar o link do repositório ao final.

## Configuração do ambiente
É necessário que você tenha o **`git`**, **`composer`** e **`docker`** instalados na sua máquina para rodar os comandos do teste
Para testes locais, além desses, é necessário ter **`PHP`** instalado (preferencialmente versão 8.4) e **`Laravel 11+`**

```
git clone https://github.com/PedroJardel/teste_analista_um_back_end_melhor_envio.git
```

### Ações manuais após o clone

1. É necessário criar uma pasta **`logs`** em ambos os diretórios => <code>**storage/app/private/logs**</code> e <code>**storage/app/public/logs**</code>;
2. Passe o arquivo **`logs.txt`** para ambas as pastas;

#### Rode o comando
```
composer run post-root-package-install
```
> Ele irá copiar os arquivo do .env.example e criará um arquivo .env

#### Após isso, rode:

```
composer run build-docker
```
> O comando acima cria as imagens da aplicação, sobe um container docker e já inicializa o servidor com php artisan serve

#### Acesse o bash do container da imagem sail

```
docker ps
```
```
docker exec -it {id_do_seu_container_sail} bash
```
> substitua o **`{id_do_seu_container_sail}`** pelo CONTAINER ID que aparece no seu terminal

#### Rode o comando dentro do bash
```
composer run start-app-docker
```
> O comando acima, vai fazer as migrações e rodar os testes;

### Postman
Importe o arquivo **`TESTE TECNICO MELHOR ENVIO.postman_collection.json`** que está na raiz do projeto para o postman;

#### Ambiente Docker
Caso a URL não venha configurada no postman crie uma variável para a coleção chamada **`'url_docker'`** com o valor **`'http://localhost:80/api`**'

#### Ambiente Local

Caso a URL não venha configurada no postman crie uma variável para a coleção chamada **`'url_local'`** com o valor **`'http://localhost:8000/api'`**;

Rode o comando
```
docker compose -f 'docker-compose-dev.yml' up -d
```
> Esse comando sobe a imagem do postgres localmente na porta 5433

Após, rode:
```
php artisan serve
```
> Esse comando inicializará o servidor localmente e rodará na porta 8000 do localhost
---
> ***OBS: altere as conexções do banco de dados no .env caso ele esteja apontando para uma imagem diferente da que você quer***

```
    # [DATABASE DOCKER IMAGE SAIL APPLICATION]
    DB_CONNECTION=pgsql
    DB_HOST=localhost
    DB_PORT=5432
    DB_DATABASE=teste_analista_um_back_end_melhor_envio
    DB_USERNAME=sail
    DB_PASSWORD=password
    DB_CHARSET=utf8
    DB_URL=pgsql://sail:password@pgsql:5432/teste_analista_um_back_end_melhor_envio
```

```
    # [DATABASE LOCAL]
    # DB_CONNECTION=pgsql
    # DB_HOST=localhost
    # DB_PORT=5433
    # DB_DATABASE=teste_analista_um_back_end_melhor_envio
    # DB_USERNAME=root
    # DB_PASSWORD=teste_analista
    # DB_CHARSET=utf8
    # DB_URL=pgsql://root:teste_analista@localhost:5433/teste_analista_um_back_end_melhor_envio
```

Rode as migrations e os testes com:
```
php artisan migrate && php artisan test
```

### Requisições
Se faz necessário definir no cabeçalho das requisições do postman o seguinte parâmetro: 
```
'Accept' => 'application/json'
```
> Garante que a validação do FormRequest não redirecione o usuário e mostre a mensagem em caso de erro, específicamente nos métodos **POST**
#### Post
Todas as requisições do tipo **POST**, <code>***EXCETO IMPORT REQUEST FILE***</Code>, recebem o mesmo corpo de requisição, porém, cada uma com um FormRequest diferente.
```
{
    "request": {
        "method": "GET",
        "uri": "\/",
        "url": "http:\/\/wolf.com",
        "size": 61,
        "querystring": [],
        "headers": {
            "accept": "*\/*",
            "host": "wolf.com",
            "user-agent": "curl\/7.37.1"
        }
    },
    "upstream_uri": "\/",
    "response": {
        "status": 500,
        "size": 847,
        "headers": {
            "Content-Length": "197",
            "via": "gateway\/1.3.0",
            "Connection": "close",
            "access-control-allow-credentials": "true",
            "Content-Type": "application\/json",
            "server": "nginx",
            "access-control-allow-origin": "*"
        }
    },
    "authenticated_entity": {
        "consumer_id": {
            "uuid": "fdbb8ab9-53c2-35c3-b0dc-0433d64c0836"
        }
    },
    "route": {
        "created_at": 1545521760,
        "hosts": "hilpert.com",
        "id": "9bb5b399-23b4-3c5a-b92b-2febdbcfa4e4",
        "methods": [
            "GET",
            "POST",
            "PUT",
            "DELETE",
            "PATCH",
            "OPTIONS",
            "HEAD"
        ],
        "paths": [
            "\/"
        ],
        "preserve_host": false,
        "protocols": [
            "http",
            "https"
        ],
        "regex_priority": 0,
        "service": {
            "id": "a5bf08bd-c030-30d5-8009-83a8c30103bf"
        },
        "strip_path": true,
        "updated_at": 1545521760
    },
    "service": {
        "connect_timeout": 60000,
        "created_at": 1549572086,
        "host": "orn.com",
        "id": "a5bf08bd-c030-30d5-8009-83a8c30103bf",
        "name": "orn",
        "path": "\/",
        "port": 80,
        "protocol": "http",
        "read_timeout": 60000,
        "retries": 5,
        "updated_at": 1549572086,
        "write_timeout": 60000
    },
    "latencies": {
        "proxy": 1644,
        "gateway": 11,
        "request": 1648
    },
    "client_ip": "227.161.59.27",
    "started_at": 1544800610
}
```

#### POST IMPORT REQUEST FILE
Esse endnpoit espera somente um arquivo type file e mimetype text/plain em uma requisição do tipo multipart/form-data.

![image](https://github.com/user-attachments/assets/8f7f2718-98fa-4eb8-b2d3-1e7d626224c5)

#### GET READ FILE
Essa requisição não precisa passar nenhum arquivo, porém, quando for executar a rota `GET READ FILE`, certifique-se de rodar o comando antes de enviar a requisição;

```
php artisan queue:listen --timeout=300
```
> Este comando fica "ouvindo" a tabela jobs mesmo sem ter um job para ser disparado. Assim que chega um job, ele automaticamente dispara.

Ou depois da de enviar a requisição com:

```
php artisan queue:work --timeout=300
```
> Este comando roda os jobs que já estão na tabela jobs para serem disparados.

### Testes
Em cada classe de testes está configurada como atributos as 2 urls **`$urlDocker`** e **`$urlLocal`**.
> Caso deseje fazer os testes em diferentes ambientes é só mudar nas simulações de requisição.

## Pontos de melhoria
- [ ] Enviar via requisição POST o arquivo logs.txt sem retornar 413 Post Too Large Content;
> 🔴 **Alta prioridade** | 🔴 **Alta complexidade** | 🎯 Cria automação do cliente em importar os dados via documento `text/plain`;

- [ ] Particionar o arquivo logs.txt em arquivos menores e adicionar eles na fila de execução (Jobs);
> 🔴 **Alta prioridade** | 🟡 **Média complexidade** | 🎯 Impacta performance da aplicacão e retira a necessidade da fila ter um timeout de 300 segundos.

- [x] Utilizar **`chunks`** para retornar os dados do banco sem perder performance;
> 🔴 **Alta prioridade** | 🟢 **Baixa Complexidade** | 🎯 Impacta performance da aplicacão | só era necessário em apenas uma requisição => **`GET REQUESTS BY SERVICE`**

- [ ] Desacoplar o código dos testes para utilizar Factories e Seeders;
> 🟢 **Baixa prioridade** | 🟢 **Baixa complexidade** | 🎯 Código funcional e escalável

- [ ] Excluir o arquivo importado após a finalização do job que preenche os dados no banco;
> 🟡 **Média prioridade** | 🟢 **Baixa complexidade** | 🎯 Custo de armazenamento;

- [ ] Automatizar o direcionamento do banco de dados, separando os ambientes e rodando em paralelo;
> 🟢 **Baixa prioridade** | 🟡 **Média Complexidade** | 🎯 CAMADA: ELOQUENT > DATABASE

- [ ] Abstrair a configuração da escolha da url de testes para um ServiceProvider;
> 🟢 **Baixa prioridade** | 🟢 **Baixa complexidade** | 🎯 Ganho em agilidade;

- [ ] Criar testes para verificação e validação de retornos vazios;
> 🔴 **Alta Prioridade** | 🟢 **Baixa complexidade** | 🎯 Clareza para o cliente do retorno da requisição | 🎯 Cobrir uma camada amais de casos de testes;
