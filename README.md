# Formulários dinamicos API

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

**ROTAS**
<p>localhost/api/formularios/form-1/preenchimentos</p>
<p>localhost/api/formularios/form-1/preenchimentos?data={
  "formId": "form-1",
  "fields": [
    {
      "field": "field-1-1",
      "value": "João Silva"
    },
    {
      "field": "field-1-2",
      "value": 30
    },
    {
      "field": "field-1-3",
      "value": "Sim"
    }
  ]
}
</p>
