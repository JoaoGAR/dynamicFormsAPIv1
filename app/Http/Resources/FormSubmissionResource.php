<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FormSubmissionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'form_id' => $this->form_id,
            'fields' => $this->fields,
        ];
    }
}
