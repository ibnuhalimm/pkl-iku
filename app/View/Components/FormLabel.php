<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormLabel extends Component
{
    public $isRequired;

    /**
     * Create a new component instance.
     *
     * @param string $isRequired
     * @return void
     */
    public function __construct($isRequired = 'false')
    {
        $this->isRequired = $isRequired;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-label');
    }
}
