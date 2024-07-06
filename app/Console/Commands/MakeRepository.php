<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
/**
 ** Funcionalidad:
*Crea un nuevo archivo de clase de repositorio en el directorio app/Repositories/.
*Genera el contenido básico de la clase de repositorio.
*Opcionalmente, incluye la importación y la inyección de un modelo específico.
**Argumentos y opciones:
*{name}: (Obligatorio) El nombre del repositorio que deseas crear.
*{--m|model=}: (Opcional) El nombre del modelo asociado al repositorio.
**Uso Básico:
*php artisan make:repository UserRepository
**Con un modelo específico:
*php artisan make:repository UserRepository --model=User
**Comportamiento:
*Crea el directorio app/Repositories/ si no existe.
*Verifica si el archivo del repositorio ya existe para evitar sobrescribirlo.
*Genera el contenido del archivo del repositorio basado en un stub.
*Si se proporciona un modelo, incluye la importación y la inyección de dependencias del modelo en el repositorio.
 */

class MakeRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name} {--m|model= : The name of the model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository class';

    /**
     * The Filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * Create a new command instance.
     *
     * @param \Illuminate\Filesystem\Filesystem $files
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');
        $model = $this->option('model');
        $path = app_path("Repositories/{$name}.php");

        // Check if the directory exists
        if (!$this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0755, true);
        }

        // Check if the file already exists
        if ($this->files->exists($path)) {
            $this->error("Repository {$name} already exists!");

            return 1;
        }

        // Create the repository file with the stub content
        $this->files->put($path, $this->getStub($name, $model));

        $this->info("Repository {$name} created successfully.");

        return 0;
    }

    /**
     * Get the stub content for the repository class.
     *
     * @param string $name
     * @param string|null $model
     * @return string
     */
    protected function getStub($name, $model = null)
    {
        $modelImport = $model ? "use App\\Models\\{$model};\n\n" : "use Illuminate\Database\Eloquent\Model;\n\n";
        $variableName = $model ? lcfirst($model) : 'model';
        $modelProperty = "\tprotected \$$variableName;\n\n";
        $modelConstructor = $model
            ? "\tpublic function __construct({$model} \$$variableName) {\n\t\t\$this->$variableName = \$$variableName;\n\t}\n"
            : "\tpublic function __construct(Model \$model) {\n\t\t\$this->model = \$model;\n\t}\n";

        return <<<EOT
<?php

namespace App\Repositories;

{$modelImport}class {$name}
{
{$modelProperty}
{$modelConstructor}
}
EOT;
    }
}
