<?php

namespace App\Http\Controllers\Form;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

use App\Services\FormService;

class FormController extends Controller
{
    protected $formService;

    public function __construct(FormService $formService)
    {
        $this->formService = $formService;
    }

    public function getForm(Request $request)
    {
        $formId = $request->formId;
        $form = $this->formService->getForm($formId);

        if (!$form) {
            return response()->json(['error' => 'Formulário não encontrado'], 404);
        }

        return Response::make($form, 200, ['Content-Type' => 'json']);
    }

    public function submitData(Request $request, $formId)
    {
        $form = $this->formService->getForm($formId);
        if (!$form) {
            return response()->json(['error' => 'Formulário não encontrado'], 404);
        }

        $validationRules = [];

        foreach ($form['fields'] as $field) {
            $rules = [];
            if ($field['required']) {
                $rules[] = 'required';
            }

            switch ($field['type']) {
                case 'text':
                    $rules[] = 'string';
                    break;
                case 'number':
                    $rules[] = 'integer';
                    break;
                case 'select':
                    $rules[] = 'in:' . implode(',', $field['choices']);
                    break;
            }

            $validationRules[$field['id']] = $rules;
        }

        $validator = Validator::make($request->input('fields'), $validationRules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $validatedData = $validator->validated();
        $submit = $this->formService->submitForm($formId, $validatedData);

        return response()->json([
            'message' => 'Dados salvos com sucesso!',
            'data' => $submit
        ], 201);
    }
}
