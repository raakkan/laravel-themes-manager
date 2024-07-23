<?php

namespace Raakkan\ThemesManager\Widget;

use Filament\Forms\Components\Field;
use Illuminate\View\View;
use Illuminate\View\Component;
use Raakkan\ThemesManager\Support\Traits\HasName;
use Raakkan\ThemesManager\Widget\Traits\HasWidgetSettings;

class BaseWidget extends Component
{
    use HasName;
    use HasWidgetSettings;

    protected string $id = '';
    protected string $view;
    protected string $source;

    protected int $order = 0;

    public function getId(): string
    {
        if (!$this->id) {
            $className = static::class;
            $name = $this->getName();
            $source = $this->getSource();
            
            $this->id = md5($className . $name . $source);
        }
        
        return $this->id;
    }

    public function getSource(): string
    {
        return $this->source;
    }

    public function setSource(string $source): self
    {
        $this->source = $source;
        return $this;
    }

    public function render(): View
    {
        return view($this->view, [
            'name' => $this->getName(),
            'order' => $this->order,
            'settings' => $this->getSettings(),
        ]);
    }
}
