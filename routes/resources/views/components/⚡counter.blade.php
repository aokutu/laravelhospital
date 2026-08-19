<?php

use Livewire\Component;

new class extends Component
{
    public $count = 0;

    public function increment()
    {
        $this->count++;
    }
};

?>

<div>

    <h1>Count: {{ $count }}</h1>

    <button wire:click="increment">
        Increase
    </button>

</div>