<?php

declare(strict_types=1);

namespace Alxarafe\ResourceTest\Tests;

use Alxarafe\ResourceController\Component\Container\TabGroup;
use Alxarafe\ResourceController\Component\Fields\Integer;
use Alxarafe\ResourceTest\DemoController;
use PHPUnit\Framework\TestCase;

class DemoControllerTest extends TestCase
{
    private \PDO $pdoMock;
    private DemoController $controller;

    protected function setUp(): void
    {
        $this->pdoMock = $this->createMock(\PDO::class);
        $this->controller = new DemoController($this->pdoMock);
    }

    public function testControllerMetadata(): void
    {
        $this->assertEquals('Showcase', DemoController::getModuleName());
        $this->assertEquals('Demo', DemoController::getControllerName());
        $this->assertStringContainsString('module=Showcase', DemoController::url());
    }

    public function testViewDescriptorStructure(): void
    {
        $view = $this->controller->getViewDescriptor();

        $this->assertArrayHasKey('mode', $view);
        $this->assertArrayHasKey('body', $view);
        $this->assertInstanceOf(TabGroup::class, $view['body']);

        $tabs = $view['body']->getFields();
        $this->assertCount(2, $tabs, 'Should have 2 main tabs');
        
        $this->assertEquals('Componentes UI', $tabs[0]->getLabel());
        $this->assertEquals('Paneles Anidados', $tabs[1]->getLabel());
    }

    public function testFieldConstraints(): void
    {
        $view = $this->controller->getViewDescriptor();
        $tabGroup = $view['body'];
        
        // Let's find the 'rating' field in the nesting tab
        // Tab 1 is 'nesting'
        $nestingTab = $tabGroup->getFields()[1];
        $panels = $nestingTab->getFields();
        
        // Panel 'Empresa Matriz' is the first one
        $mainPanel = $panels[0];
        $fields = $mainPanel->getFields();
        
        // Find Integer field 'rating'
        $ratingField = null;
        foreach ($fields as $field) {
            if ($field instanceof Integer && $field->getField() === 'rating') {
                $ratingField = $field;
                break;
            }
        }

        $this->assertNotNull($ratingField, 'Rating field should exist');
        
        // Check constraints (options are usually wrapped in an 'options' key in the constructor)
        $options = $ratingField->getOptions();
        $config = $options['options'] ?? $options;
        
        $this->assertEquals(1, $config['min']);
        $this->assertEquals(10, $config['max']);
    }
}
