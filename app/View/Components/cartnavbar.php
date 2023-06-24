<?php

namespace App\View\Components;

use App\facades\Cart;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class cartnavbar extends Component
{
    public $items;
    public $total;
    /**\\
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->items = Cart::get();
        $this->total = Cart::Total();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cartnavbar');
    }
}
