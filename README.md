# Sistema de Gerenciamento de Projetos do IComp/UFAM

Código do sistema de gerenciamento de projetos do Instituto de Computação da UFAM. Professor responsável pelo código: David Fernandes de Oliveira.

## Como contribuir

Para contribuir com este trabalho, crie um fork deste projeto em sua conta no Github e submeta suas contribuições através de Pull Requests. Esse fork deve ser feito a partir do repositório original, que pode ser acessado através do endereço abaixo:

```
https://github.com/dbfernandes/projetos
```

## Como instalar este sistema

O primeiro passo para instalação é fazer um fork do repositório original do sistema em sua conta do Github. Para fazer isso, acesse endereço (https://github.com/dbfernandes/projetos) e click o botão fork desse repositório (vide imagem abaixo).

![Fork no Github](http://coyote.icomp.ufam.edu.br/projetos/fork2.png)

Após o fork, você pode clonar seu novo repositório através do comando git clone:

```
$ git clone https://github.com/<seu usuário no github>/projetos
```

Feito o clone, basta seguir as orientações de instalação de qualquer sistema desenvolvido através do Yii 2. O primeiro passo é instalar as dependências do sistema através do composer, mas antes disso, temos que instalar o [composer asset plugin](https://github.com/fxpio/composer-asset-plugin), caso ele ainda não tenha sido instalado previamente:

```
$ php composer.phar global require "fxp/composer-asset-plugin:^1.3.1"
```

Feito isso, podemos instalar as dependências do sistema normalmente

```
$ php composer.phar --prefer-dist install
```

Depois disso, inicialize seu sistema através do comando abaixo. Você será questionado se deseja criar um ambiente de desenvolvimento ou produção. Caso você pretenda fazer edições no código do repositório, ou contribuir com este projeto, opte pelo ambiente de desenvolvimento.

```
$ php init
```

O diretório `database` possui o dump de um banco de dados que pode ser usado para su Uma vez inicializado seu sistema, use o dump de banco de dados disponível no diretório database. Esse Dump foi gerado a partir do sistema em produção, e foi colocado no Codebench porque possui dados sigilosos.

Crie um banco de dados MySQL em seu sistema e carregue o dump no novo banco. Após isso, abra o arquivo `common/config/main-local.php` e informe os dados de acesso do banco.

Também é importante acessar o diretório `backend/views/adminLTE/yiisoft/yii2-app/layouts` e criar o menu da aplicação (arquivo `left.php`). Esse diretório contém um arquivo chamado `left-sample.php` que você pode usar para gerar o menu da sua aplicação através dos seguintes comandos:

```
$ cd backend/views/adminLTE/yiisoft/yii2-app/layouts
$ cp left-sample.php left.php
```
Para acessar o backend, você pode usar o seguinte usuário:

```
Nome Completo: Usuário Todo Poderoso
CPF: 878.832.797-34
Senha: Utp102030
```
