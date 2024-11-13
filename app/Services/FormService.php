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

            if (!is_array($formSubmission) && !is_object($formSubmission)) {
                $formSubmission = json_decode($formSubmission, true);
            }

            $submit = $this->formSubmissionDAO->saveFormSubmission($formId, $formSubmission);
            return $submit;

        } catch (\Throwable $th) {
            return null;
        }
    }
}
