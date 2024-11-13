<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\File;

class FormService
{
    public function getForm($formId)
    {
        $jsonPath = public_path('forms_definition.json');

        if (!File::exists($jsonPath)) {
            return null;
        }

        $forms = json_decode(File::get($jsonPath), true);
        $form = collect($forms)->firstWhere('id', $formId);

        if (!$form) {
            return null;
        }

        return $form;
    }
}
