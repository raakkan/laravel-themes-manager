<?php

namespace Raakkan\ThemesManager\Builder\Livewire;

use Livewire\Component;
use Livewire\Attributes\Modelable;

class Block extends Component
{
    public $block = [];
    public $blocks = [];
    public function handleDrop($data)
    {
        $this->blocks[] = array_merge($data, ['id' => uniqid()]);
    }

    public function render()
    {
        return view('themes-manager::builder.livewire.block');
    }
}