<?php

declare(strict_types=1);

namespace PHP\FactoryMethod\NotebookFactoryMethod;

abstract class NotebookCreator
{
    abstract public function factoryNotebook(): Notebook;

    public function createNotebook(string $device): void
    {
        $notebook = $this->factoryNotebook();
        //.......
        //.......
        //.......
        $notebook->createNotebook($device);
    }
}

class AsusCreator extends NotebookCreator
{
    private $display, $cpu;

    public function __construct(string $display, string $cpu)
    {
        $this->display = $display;
        $this->cpu = $cpu;
    }

    public function factoryNotebook(): Notebook
    {
        return new AsusNotebook($this->display, $this->cpu);
    }
}

class DellCreator extends NotebookCreator
{
    private $memory, $cpu;

    public function __construct(string $memory, string $cpu)
    {
        $this->memory = $memory;
        $this->cpu = $cpu;
    }

    public function factoryNotebook(): Notebook
    {
        return new DellNotebook($this->memory, $this->cpu);
    }
}

interface Notebook
{
    public function createNotebook(string $device): void;
}

class AsusNotebook implements Notebook
{
    private $display, $cpu;

    public function __construct(string $display, string $cpu)
    {
        $this->display = $display;
        $this->cpu = $cpu;
    }

    public function createNotebook(string $device): void
    {
        echo 'Asus '. $device . ': ' . $this->display . '/' . $this->cpu;
    }
}

class DellNotebook implements Notebook
{
    private $memory, $cpu;

    public function __construct(string $memory, string $cpu)
    {
        $this->memory = $memory;
        $this->cpu = $cpu;
    }

    public function createNotebook(string $device): void
    {
        echo 'Dell '. $device . ': ' . $this->memory . '/' . $this->cpu;
    }
}




function clientCode(NotebookCreator $notebookCreator)
{
    $notebookCreator->createNotebook('Notebook');
}

echo 'Shop Asus notebook: ' . PHP_EOL;
clientCode(new AsusCreator('19D', 'i5'));
echo PHP_EOL . PHP_EOL;

echo 'Shop Dell notebook: ' . PHP_EOL;
clientCode(new DellCreator('8Gb', 'i3'));
echo PHP_EOL . PHP_EOL;