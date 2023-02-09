<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Post;

class bigsliderpost extends Component
{
    public $image;

    public $author;

    public $category;

    public $timestamp;

    public $name;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($image, $author, $category, $timestamp, $name)
    {
        $this->image = $image;
        $this->name = $name;
        $this->author = $author;
        $this->category = $category;
        $this->timestamp = $timestamp;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.bigsliderpost');
    }
}
