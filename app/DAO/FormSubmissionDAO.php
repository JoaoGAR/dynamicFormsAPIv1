<?php

namespace App\DAO;

use App\Models\FormSubmission;

class FormSubmissionDAO
{
    public function saveFormSubmission($formId, $formSubmission)
    {
        try {

            $submit = FormSubmission::create([
                'form_id' => $formId,
                'fields' => $formSubmission
            ]);
            return $submit;
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function getFormSubmissions($formId)
    {
        try {
            $submissions = FormSubmission::where('form_id', $formId)->get();
            return $submissions;
        } catch (\Throwable $th) {
            return null;
        }
    }
}
