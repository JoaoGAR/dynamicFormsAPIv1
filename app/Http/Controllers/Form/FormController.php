<?php

namespace App\Http\Controllers\Form;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

use App\Services\FormService;
use App\Services\FormSubmissionValidator;
use App\Http\Resources\FormSubmissionResource;

class FormController extends Controller
{
    protected $formService;
    protected $formSubmissionValidator;

    public function __construct(FormService $formService, FormSubmissionValidator $formSubmissionValidator)
    {
        $this->formService = $formService;
        $this->formSubmissionValidator = $formSubmissionValidator;
    }

    public function getForm(Request $request)
    {
        $formId = $request->formId;
        $form = $this->formService->getForm($formId);
        if (!$form) {
            return response()->json(['error' => 'Formulário não encontrado.'], 404);
        }

        return Response::make($form, 200, ['Content-Type' => 'json']);
    }

    public function submitData(Request $request, $formId)
    {
        $form = $this->formService->getForm($formId);
        if (!$form) {
            return response()->json(['error' => 'Formulário não encontrado.'], 404);
        }

        $formSubmission = $request->data;
        $formSubmission = json_decode($formSubmission, true);
        $validationRules = [];
        $preparedData = [];

        foreach ($formSubmission['fields'] as $fieldData) {
            $preparedData[$fieldData['field']] = $fieldData['value'];
        }

        $this->formSubmissionValidator->setRules($form['fields']);
        $validationResult = $this->formSubmissionValidator->validate($preparedData);

        if (!$validationResult->passes()) {
            return response()->json(['errors' => $validationResult->errors()], 400);
        }
        
        $submit = $this->formService->submitForm($formId, $formSubmission);

        if (!$submit) {
            return response()->json(['error' => 'Falha ao salvar valores.'], 400);
        }

        return response()->json([
            'message' => 'Dados salvos com sucesso!',
            'data' => $submit
        ], 201);
    }

    public function getFormSubmissions($formId)
    {
        $form = $this->formService->getForm($formId);
        if (!$form) {
            return response()->json(['error' => 'Formulário não encontrado.'], 404);
        }

        $data = $this->formService->getFormSubmissions($formId);
        $data = FormSubmissionResource::collection($data);

        return response()->json([
            'message' => 'Dados carregados com sucesso!',
            'data' => $data
        ], 201);
    }
}
