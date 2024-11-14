<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;

class FormSubmissionValidator
{
    protected $rules = [];

    public function setRules(array $fields)
    {
        foreach ($fields as $field) {
            $fieldRules = [];
            if ($field['required']) {
                $fieldRules[] = 'required';
            }

            switch ($field['type']) {
                case 'text':
                    $fieldRules[] = 'string';
                    break;
                case 'number':
                    $fieldRules[] = 'integer';
                    break;
                case 'select':
                    $fieldRules[] = 'in:' . implode(',', $field['choices']);
                    break;
            }

            $this->rules[$field['id']] = $fieldRules;
        }
    }

    public function validate(array $data)
    {
        return Validator::make($data, $this->rules);
    }
}
