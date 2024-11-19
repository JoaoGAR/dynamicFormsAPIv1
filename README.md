
# Formulários dinamicos API

## Requisitos

> PHP: >= 8.1
> Laravel: >= 10.x
> Banco de Dados suportado: MySQL, PostgreSQL ou SQLite
> Composer para gerenciar dependências.

>[!NOTE]
    <p>Caso esteja usando Docker destop para windows é necessário clonar o repositório para dentro do Ubunto do WSL2</p>
    <p>Geralmente Linux/Ubuntu/home/usuario do WSL</p>

 

## Ambiente Docker configurado com o Laravel Sail.

[Laravel 11 Sail Documentação: https://laravel.com/docs/11.x/sail#installing-sail-into-existing-applications](https://laravel.com/docs/11.x/sail#installing-sail-into-existing-applications)

**Execute**
***./vendor/bin/sail up -d***


**Execute as migrations e seeds**
>[!NOTE]
    Caso dentro do WSL **./vendor/bin/sail artisan migrate** **./vendor/bin/sail artisan db:seed**


# Endpoints

**1. Listar Formulários**
GET '/api/forms'
    Retorna uma lista de todos os formulários disponíveis.

*** Resposta de Sucesso: ***
json:
`` [
    {
        "id": 1,
        "name": "Formulário de Cadastro",
        "fields": [
            {
                "id": "name",
                "label": "Nome",
                "type": "text",
                "required": true
            },
            {
                "id": "age",
                "label": "Idade",
                "type": "number",
                "required": false
            }
        ]
    }
] ``
Erros: N/A


**2. Exibir Formulário Específico**
GET /api/forms/{id}
    Retorna a estrutura de um formulário específico.

### Parâmetros:

> id: ID do formulário.

***Resposta de Sucesso:***
`` {
    "id": 1,
    "name": "Formulário de Cadastro",
    "fields": [
        {
            "id": "name",
            "label": "Nome",
            "type": "text",
            "required": true
        },
        {
            "id": "age",
            "label": "Idade",
            "type": "number",
            "required": false
        }
    ]
} ``
***Erros:***
> 404: Formulário não encontrado.


**3. Submeter Dados de Formulário**
POST /api/forms/{id}/submit
    Valida e armazena os dados submetidos para um formulário.

### Parâmetros:

> id: ID do formulário.
> Body (JSON):
`` {
    "data": {
        "fields": [
            {
                "field": "name",
                "value": "João Silva"
            },
            {
                "field": "age",
                "value": 30
            }
        ]
    }
} ``

***Resposta de Sucesso:***
`` {
    "message": "Dados salvos com sucesso!",
    "data": {
        "form_id": 1,
        "submission_id": 15
    }
} ``

***Erros:***
> 404: Formulário não encontrado.
> 400: Erros de validação ou falha ao salvar os dados.

`` {
    "errors": {
        "name": ["O campo Nome é obrigatório."]
    }
} ``