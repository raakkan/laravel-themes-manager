<?php

namespace Raakkan\ThemesManager\Widget;

use Illuminate\Support\Str;

class WidgetLocation
{
    protected string $name;

    protected string $label;

    protected string $source;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function make(string $name): self
    {
        return new static($name);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function label(string $label): self
    {
        $this->label = $label;
        return $this;
    }

    public function getLabel(): string
    {
        return $this->label ?? Str::headline(str_replace('_', ' ', $this->name));
    }

    public function getSource(): string
    {
        return $this->source;
    }
}
