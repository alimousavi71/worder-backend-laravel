<?php

namespace App\Console\Commands;

use Exception;
use File;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class MakeModule extends Command
{
    protected $signature = 'make:module {name}';
    protected $description = 'Create Module';
    protected string $nameModule = '';
    protected string $basePath = '';
    protected array $columns = [];
    protected string $renderColumn = '';
    private string $stubPath;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws Exception
     */
    private function getColumns(string $tableName): array
    {
        try {
            $columns = Schema::getColumnListing($tableName);
            $columnSchema = [];
            if (!count($columns)) {
                throw new Exception('Columns not found');
            }
            foreach ($columns as $column) {
                $type = Schema::getColumnType($tableName, $column);
                $columnSchema[] = [
                    'name' => $column,
                    'type' => $type,
                ];
            }
            return $columnSchema;
        } catch (Exception $exception) {
            throw new Exception('Columns error : ' . $exception->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    private function makeController()
    {
        try {
            $controllerPath = $this->basePath . '/app/Http/Controllers/Admin/';
            $controllerName = ucfirst($this->nameModule) . 'Controller.php';
            File::put($controllerPath . $controllerName, $this->handleStub('controller.stub'));
            $this->info(sprintf('Controller %s Created', $controllerName));
        } catch (Exception $exception) {
            throw new Exception('Make Controller Error : ' . $exception->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    private function makeRequests()
    {
        try {
            $requestPath = $this->basePath . '/app/Http/Requests/Admin/' . ucfirst($this->nameModule);
            $this->makeDir($requestPath);
            $this->info(sprintf('Request Folder With Path %s Created', $requestPath));

            $requestStore = 'StoreRequest.php';
            $requestUpdate = 'UpdateRequest.php';

            File::put($requestPath . '/' . $requestStore, $this->handleStub('request-store.stub'));
            $this->info(sprintf('Request File %s Created', $requestStore));

            File::put($requestPath . '/' . $requestUpdate, $this->handleStub('request-update.stub'));
            $this->info(sprintf('Request File %s Created', $requestUpdate));

        } catch (Exception $exception) {
            throw new Exception('Make Controller Error : ' . $exception->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    private function makeViews()
    {
        try {
            $viewPath = $this->basePath . '/resources/views/admin/' . $this->nameModule;
            $this->makeDir($viewPath);
            $this->info(sprintf('View Folder With Path %s Created', $viewPath));

            $viewIndex = 'index.blade.php';
            File::put($viewPath . '/' . $viewIndex, $this->handleStub('view-index.stub'));
            $this->info(sprintf('View %s Created', $viewIndex));

            $viewCreate = 'create.blade.php';
            $this->makeInputByColumns();
            File::put($viewPath . '/' . $viewCreate, $this->handleStub('view-create.stub'));
            $this->info(sprintf('View %s Created', $viewCreate));

            $viewEdit = 'edit.blade.php';
            $this->makeInputByColumns(true);
            File::put($viewPath . '/' . $viewEdit, $this->handleStub('view-edit.stub'));
            $this->info(sprintf('View %s Created', $viewEdit));

            $viewShow = 'show.blade.php';
            File::put($viewPath . '/' . $viewShow, $this->handleStub('view-show.stub'));
            $this->info(sprintf('View %s Created', $viewShow));

        } catch (Exception $exception) {
            throw new Exception('Make Controller Error : ' . $exception->getMessage());
        }
    }

    private function makeInputByColumns(bool $editMode = false)
    {
        $this->renderColumn = '';
        $skipColumns = ['created_at', 'updated_at', 'id'];
        foreach ($this->columns as $column) {
            if (in_array($column['name'], $skipColumns)) {
                continue;
            }
            $editString = '';
            if ($editMode) {
                $editString = sprintf(':old="$%s->%s"', $this->nameModule, $column['name']);
            }
            switch ($column['type']) {
                case 'boolean':
                {
                    $this->renderColumn .= sprintf('<x-admin.checkbox identify="%s" :description="%s" %s />' . PHP_EOL,
                        $column['name'],
                        sprintf("trans('fields.%s.%s')",strtolower($this->nameModule), $column['name']),
                        $editString,
                    );
                    break;
                }
                default:
                {
                    $this->renderColumn .= sprintf('<x-admin.input identify="%s" :title="%s" type="text" />' . PHP_EOL,
                        $column['name'],
                        sprintf("trans('fields.%s.%s')",strtolower($this->nameModule), $column['name']),
                        $column['name']
                    );
                }
            }

        }
    }

    public function handle()
    {
        try {
            $this->stubPath = app()->basePath("stubs/generate/");
            $this->nameModule = $this->argument('name');
            $this->basePath = app()->basePath();

            /* Make Scheme Columns */
            $pluralName = str($this->nameModule)->plural();
            $this->columns = $this->getColumns($pluralName);

            /* Make Controller */
            $this->makeController();

            /* Make Request */
            $this->makeRequests();

            /* Make View */
            $this->makeViews();

            /* Append To Admin Route */
            $this->info($this->handleStub('admin-route.stub'));

        } catch (Exception $exception) {
            $this->info($exception->getMessage());
        }
        return 0;
    }

    private function stubVariables(): array
    {
        return [
            'CLASS_NAME' => ucfirst($this->argument('name')),
            'APP_NAME' => ucfirst(config('app.name')),
            'ROUTE_NAME' => strtolower($this->nameModule),
            'VIEW_NAME' => strtolower($this->nameModule),
            'NAME' => strtolower($this->nameModule),
            'MODEL_VAR_NAME' => strtolower($this->nameModule),
            'NAME_PLURAL' => str($this->nameModule)->plural(),
            'COLUMNS' => $this->renderColumn,
        ];
    }

    private function handleStub($stubName)
    {
        $contents = File::get($this->stubPath . $stubName);
        foreach ($this->stubVariables() as $search => $replace) {
            $contents = str_replace('$' . $search . '$', $replace, $contents);
        }
        return $contents;
    }

    public function makeDir($path)
    {
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
        return $path;
    }
}
