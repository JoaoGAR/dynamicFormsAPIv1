<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use App\DAO\FormSubmissionDAO;

class FormService
{
    protected $formSubmissionDAO;

    public function __construct(FormSubmissionDAO $formSubmissionDAO)
    {
        $this->formSubmissionDAO = $formSubmissionDAO;
    }

    public function getForm($formId)
    {
        try {

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
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function submitForm($formId, $formSubmission)
    {
        try {
            $submit = $this->formSubmissionDAO->saveFormSubmission($formId, $formSubmission);
            return $submit;
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function getFormSubmissions($formId)
    {
        try {
            $data = $this->formSubmissionDAO->getFormSubmissions($formId);
            return $data;
        } catch (\Throwable $th) {
            return null;
        }
    }
}
