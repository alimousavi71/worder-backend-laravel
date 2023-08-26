<?php

namespace App\Http\Controllers\Admin;

use App\AcfType\AcfTypeFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AcfFieldAttach\StoreRequest;
use App\Models\AcfTemplate;
use Exception;

class AcfFieldAttachController extends Controller
{
    public function store(StoreRequest $request, AcfTemplate $acfTemplate)
    {
        try {

            $acfTemplate->acfFields()->delete();

            foreach ($request->get('fields') as $field) {

                $acfTemplate->acfFields()->create([
                    'label' => $field['label'],
                    'name' => $field['name'],
                    'description' => $field['description'],
                    'required' => isset($field['required']) ? 1 : 0,
                    'type' => $field['type'],
                    'props' => $this->detectFieldProps($field),
                ]);
            }

            return response()->json([
                'result' => 'success',
                'message' => trans('panel.success_store'),

            ]);
        } catch (Exception $e) {
            report($e);

            return response()->json([
                'result' => 'exception',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * @throws Exception
     */
    private function detectFieldProps(array $field): array
    {
        switch ($field['type']) {
            case 'Text':

                return AcfTypeFactory::text($field['name'], $field['label'], $field['required'] ?? false)
                    ->withPlaceHolder($field['placeHolder'] ?? '')
                    ->withDefaultValue($field['default'] ?? '')
                    ->withCharLimit($field['charLimit'] ?? 0)
                    ->build()
                    ->toArray();

            case 'Textarea':

                return AcfTypeFactory::textarea($field['name'], $field['label'], $field['required'] ?? false)
                    ->withPlaceHolder($field['placeHolder'] ?? '')
                    ->withDefaultValue($field['default'] ?? '')
                    ->withCharLimit($field['charLimit'] ?? 0)
                    ->withRows($field['rows'] ?? 5)
                    ->build()
                    ->toArray();

            case 'Email':

                return AcfTypeFactory::email($field['name'], $field['label'], $field['required'] ?? false)
                    ->withPlaceHolder($field['placeHolder'] ?? '')
                    ->withDefaultValue($field['default'] ?? '')
                    ->build()
                    ->toArray();

            case 'Url':

                return AcfTypeFactory::url($field['name'], $field['label'], $field['required'] ?? false)
                    ->withPlaceHolder($field['placeHolder'] ?? '')
                    ->withDefaultValue($field['default'] ?? '')
                    ->build()
                    ->toArray();

            case 'Range':

                if (! is_numeric($field['minimum']) || ! is_numeric($field['maximum'])) {
                    throw new Exception('Minimum or Maximum must be numeric');
                }

                return AcfTypeFactory::range($field['name'], $field['label'], $field['required'] ?? false)
                    ->withMinimum((float) $field['minimum'] ?? 0)
                    ->withMaximum((float) $field['maximum'] ?? 0)
                    ->withDefaultMinimum($field['defaultMinimum'] ?? null)
                    ->withDefaultMaximum($field['defaultMaximum'] ?? null)
                    ->build()
                    ->toArray();

        }

        return [];
    }
}
