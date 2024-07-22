<?php

namespace Raakkan\ThemesManager\Widget;

use Illuminate\View\View;
use Illuminate\View\Component;
use Raakkan\ThemesManager\Support\Traits\HasName;

class BaseWidget extends Component
{
    use HasName;

    protected string $location;
    protected array $options = [];

    public function getOptions(): array
    {
        return $this->options;
    }

    public function setOptions(array $options): self
    {
        $this->options = $options;
        return $this;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;
        return $this;
    }

    public function render(): View
    {
        return view('components.alert');
    }
}
