<?php

declare(strict_types=1);

namespace Alxarafe\ResourceTest;

use Alxarafe\ResourceController\AbstractResourceController;
use Alxarafe\ResourceController\Component\Container\Panel;
use Alxarafe\ResourceController\Component\Container\Row;
use Alxarafe\ResourceController\Component\Container\Separator;
use Alxarafe\ResourceController\Component\Container\Tab;
use Alxarafe\ResourceController\Component\Container\TabGroup;
use Alxarafe\ResourceController\Component\Fields\Boolean;
use Alxarafe\ResourceController\Component\Fields\Date;
use Alxarafe\ResourceController\Component\Fields\DateTime;
use Alxarafe\ResourceController\Component\Fields\Decimal;
use Alxarafe\ResourceController\Component\Fields\Icon;
use Alxarafe\ResourceController\Component\Fields\Integer;
use Alxarafe\ResourceController\Component\Fields\Select;
use Alxarafe\ResourceController\Component\Fields\Text;
use Alxarafe\ResourceController\Component\Fields\Textarea;
use Alxarafe\ResourceController\Component\Fields\Time;
use Alxarafe\ResourceController\Contracts\RepositoryContract;
use Alxarafe\ResourceController\Contracts\TransactionContract;
use Alxarafe\ResourcePdo\PdoRepository;
use Alxarafe\ResourcePdo\PdoTransaction;

class DemoController extends AbstractResourceController
{
    private \PDO $pdo;
    public string $title;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
        
        $this->mode = self::MODE_EDIT;
        $this->recordId = 'demo';
        $this->protectChanges = false;
        $this->title = 'Alxarafe Showcase Demo';
    }

    public static function getModuleName(): string
    {
        return 'Showcase';
    }

    public static function getControllerName(): string
    {
        return 'Demo';
    }

    public static function url(string $action = 'index', array $params = []): string
    {
        return '?module=Showcase&controller=Demo';
    }

    #[\Override]
    protected function getRepository(string $tabId = 'default'): RepositoryContract
    {
        return new PdoRepository($this->pdo, 'demo_table');
    }

    #[\Override]
    protected function getTransaction(): TransactionContract
    {
        return new PdoTransaction($this->pdo);
    }

    #[\Override]
    public function getViewDescriptor(): array
    {
        return [
            'mode'     => $this->mode,
            'method'   => 'POST',
            'action'   => '?action=save',
            'recordId' => $this->recordId,
            'buttons'  => [
                ['label' => 'Guardar Datos', 'icon' => 'fas fa-save', 'type' => 'primary', 'action' => 'submit', 'name' => 'save'],
            ],
            'body' => new TabGroup([
                new Tab('components', 'Componentes UI', 'fas fa-puzzle-piece', $this->buildComponentsPanels()),
                new Tab('nesting', 'Paneles Anidados', 'fas fa-boxes-stacked', $this->buildNestingPanels()),
            ]),
        ];
    }

    protected function buildComponentsPanels(): array
    {
        return [
            new Panel('Configuración Principal', [
                new Text('name', 'Nombre del Recurso', ['required' => true]),
                new Textarea('description', 'Descripción Técnica', ['rows' => 3]),
                new Boolean('active', 'Publicado'),
            ], ['col' => 'col-md-7']),

            new Panel('Estética', [
                new Icon('icon', 'Icono', ['default' => 'fas fa-rocket']),
                new Select('type', 'Clasificación', [
                    'core' => 'Sistema Core',
                    'plugin' => 'Extensión',
                ]),
            ], ['col' => 'col-md-5']),

            new Panel('Cronología', [
                new Date('date', 'Fecha Hito'),
                new DateTime('datetime', 'Registro Auditoría'),
                new Time('time', 'Hora'),
            ], ['col' => 'col-md-12', 'class' => 'mt-3']),
        ];
    }

    protected function buildNestingPanels(): array
    {
        return [
            new Panel('Empresa Matriz', [
                new Text('company_name', 'Nombre de la empresa'),
                new Panel('Dirección Fiscal', [
                    new Text('address_street', 'Calle'),
                    new Text('address_city', 'Ciudad'),
                    new Panel('Contacto Principal', [
                        new Text('contact_phone', 'Teléfono', ['col' => 'col-md-6']),
                        new Text('contact_email', 'Email', ['col' => 'col-md-6']),
                    ], ['col' => 'col-12', 'class' => 'mt-3']),
                ], ['col' => 'col-12', 'class' => 'mt-3']),
            ], ['col' => 'col-12']),
        ];
    }

    #[\Override]
    protected function fetchRecordData(): array
    {
        return ['id' => 'demo', 'data' => []];
    }

    #[\Override]
    protected function getListColumns(): array
    {
        return [];
    }
}
