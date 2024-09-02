# API de Gerenciamento de Alunos e Cursos

## Visão Geral
Esta API PHP fornece um conjunto de endpoints para gerenciar informações sobre alunos e cursos em um banco de dados. As operações suportadas incluem:

* **Listagem:** Obter todos os alunos, um aluno específico, todos os cursos ou um curso específico.
* **Criação:** Inserir novos registros de alunos e cursos.
* **Atualização:** Modificar informações existentes de alunos e cursos.
* **Deleção:** Remover registros de alunos e cursos.

## Endpoints
### Estrutura das URLs
As URLs seguem o padrão a seguir:

http://seu-dominio/api.php/{entidade}/{id}

Onde:
* **entidade:** `alunos` ou `cursos`
* **id:** (opcional) Identificador único do registro

### Métodos HTTP
* **GET:** Utilizado para listar registros.
* **POST:** Utilizado para criar novos registros.
* **PUT:** Utilizado para atualizar registros existentes.
* **DELETE:** Utilizado para remover registros.

### Exemplos de Requisições
* Listar todos os alunos: `GET http://seu-dominio/api.php/alunos`
* Obter um aluno específico: `GET http://seu-dominio/api.php/alunos/3`
* Criar um novo curso: `POST http://seu-dominio/api.php/cursos` (corpo da requisição: {"nome_curso": "Curso de Python"})

## Funcionalidades Detalhadas
* **Listagem:** Retorna um array JSON com os registros encontrados.
* **Criação:** Retorna uma mensagem de sucesso ou erro.
* **Atualização:** Retorna uma mensagem de sucesso ou erro.
* **Deleção:** Retorna uma mensagem de sucesso ou erro.

## Dependências
* PHP
* Extensão MySQLi
* Um servidor web (Apache, Nginx, etc.)

## Instalação e Configuração
1. **Clone o repositório:**
   ```bash
   git clone https://github.com/ProfAndersonVanin/exercicio.git
