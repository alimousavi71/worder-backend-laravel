<?php

namespace App\Http\Controllers\Admin\Acf;

use App\Acf\Type\AcfTypeFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Acf\Field\StoreRequest;
use App\Models\AcfField;
use App\Models\AcfTemplate;
use function back;
use Exception;
use function report;
use function response;
use function str;
use function trans;

class FieldController extends Controller
{
    public function attach(StoreRequest $request, int $templateId)
    {

        try {

            $template = AcfTemplate::query()
                ->findOrFail($templateId);

            if (! count($request->get('fields', []))) {
                return response()->json([
                    'result' => 'success',
                    'message' => trans('panel.success_store'),

                ]);
            }

            foreach ($request->get('fields') as $field) {

                AcfField::updateOrCreate([
                    'acf_template_id' => $template->id,
                    'id' => $field['id'] ?? null,
                ], [
                    'label' => $field['label'],
                    'name' => $field['name'],
                    'description' => $field['description'],
                    'required' => isset($field['required']) ? 1 : 0,
                    'type' => $field['type'],
                    'props' => $this->detectFieldProps($field),
                    'sort_position' => $field['sort_position'],
                ]);

            }

            return response()->json([
                'result' => 'success',
                'refresh' => true,
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

    public function delete($fieldId)
    {
        try {
            AcfField::query()
                ->where('id', $fieldId)
                ->delete();

            return back()->with('success', trans('panel.success_delete'));
        } catch (Exception $exception) {
            return back()->with('danger', $exception->getMessage());

        }
    }

    /**
     * @throws Exception
     */
    private function detectFieldProps(array $field): array
    {
        switch ($field['type']) {
            case 'Select':

                if (empty($field['select'])) {
                    throw new Exception('Items Select Empty');
                }

                $items = explode(PHP_EOL, $field['select']);
                $options = [];
                foreach ($items as $item) {
                    if (str($item)->contains(':')) {
                        $item = explode(':', $item);
                        $options[] = [
                            'label' => $item[0],
                            'value' => $item[1],
                            'old' => $item[0].':'.$item[1],
                        ];
                    } else {
                        $options[] = [
                            'label' => $item,
                            'value' => $item,
                            'old' => $item,
                        ];
                    }

                }

                return AcfTypeFactory::select($field['name'], $field['label'], $field['required'] ?? false)
                    ->withPlaceHolder($field['placeHolder'] ?? null)
                    ->withDefaultValue($field['defaultValue'] ?? null)
                    ->withDescription($field['description'] ?? null)
                    ->withSelect($options ?? [])
                    ->withMultiple($field['multiple'] ?? false)
                    ->build()
                    ->toArray();
            case 'Text':

                return AcfTypeFactory::text($field['name'], $field['label'], $field['required'] ?? false)
                    ->withPlaceHolder($field['placeHolder'] ?? null)
                    ->withDefaultValue($field['defaultValue'] ?? null)
                    ->withDescription($field['description'] ?? null)
                    ->withCharLimit($field['charLimit'] ?? null)
                    ->build()
                    ->toArray();

            case 'Textarea':

                return AcfTypeFactory::textarea($field['name'], $field['label'], $field['required'] ?? false)
                    ->withPlaceHolder($field['placeHolder'] ?? null)
                    ->withDefaultValue($field['defaultValue'] ?? null)
                    ->withDescription($field['description'] ?? null)
                    ->withCharLimit($field['charLimit'] ?? null)
                    ->withRows($field['rows'] ?? 5)
                    ->build()
                    ->toArray();

            case 'Number':
                if (empty($field['maximum']) || ! is_numeric($field['maximum'])) {
                    throw new Exception('Enter maximum or not number');
                }

                return AcfTypeFactory::number($field['name'], $field['label'], $field['required'] ?? false)
                    ->withPlaceHolder($field['placeHolder'] ?? null)
                    ->withDefaultValue($field['defaultValue'] ?? null)
                    ->withDescription($field['description'] ?? null)
                    ->withMaximum($field['maximum'])
                    ->build()
                    ->toArray();

            case 'Image':

                if (! is_int((int) $field['size']) || (int) $field['size'] <= 0) {
                    throw new Exception('Enter size with number');
                }

                if (empty($field['extensions'])) {
                    throw new Exception('Enter extensions');
                }

                $validExtensions = ['jpg', 'png', 'gif', 'svg', 'jpeg'];
                $extensions = explode(',', $field['extensions']);
                foreach ($extensions as $extension) {
                    if (! in_array($extension, $validExtensions)) {
                        throw new Exception(sprintf('File extension %s is not valid.', $extension));
                    }
                }

                return AcfTypeFactory::image($field['name'], $field['label'], $extensions, $field['required'] ?? false)
                    ->withPlaceHolder($field['placeHolder'] ?? null)
                    ->withDefaultValue($field['defaultValue'] ?? null)
                    ->withDescription($field['description'] ?? null)
                    ->withAlt($field['alt'] ?? null)
                    ->withSize($field['size'])
                    ->withWidth($field['width'] ?? null)
                    ->withHeight($field['height'] ?? null)
                    ->build()
                    ->toArray();

            case 'Email':

                return AcfTypeFactory::email($field['name'], $field['label'], $field['required'] ?? false)
                    ->withPlaceHolder($field['placeHolder'] ?? null)
                    ->withDefaultValue($field['defaultValue'] ?? null)
                    ->withDescription($field['description'] ?? null)
                    ->build()
                    ->toArray();

            case 'Url':

                return AcfTypeFactory::url($field['name'], $field['label'], $field['required'] ?? false)
                    ->withPlaceHolder($field['placeHolder'] ?? null)
                    ->withDefaultValue($field['defaultValue'] ?? null)
                    ->withDescription($field['description'] ?? null)
                    ->build()
                    ->toArray();

            case 'Range':

                if (! is_numeric($field['minimum']) || ! is_numeric($field['maximum'])) {
                    throw new Exception('Minimum or Maximum must be numeric');
                }

                return AcfTypeFactory::range($field['name'], $field['label'], $field['required'] ?? false)
                    ->withDescription($field['description'] ?? null)
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
