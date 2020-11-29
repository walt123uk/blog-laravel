<?php

namespace App\View\Components\Posts;

use Illuminate\View\Component;

class Alert extends Component
{
    public $message;

    /**
     * Create a new component instance.
     *
     * @param $message
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.posts.alert');
    }
}
