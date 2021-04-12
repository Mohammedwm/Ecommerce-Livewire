<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\HomeCategory;
use App\Models\HomeSlider;
use App\Models\Product;
use App\Models\Sale;
use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        $sliders = HomeSlider::where('status',1)->get();
        $lproducts = Product::orderby('created_at','DESC')->get()->take(8);
        $category = HomeCategory::find(1);
        $cars = explode(',',$category->sel_categories);
        $categories = Category::whereIn('id',$cars)->get();
        $no_of_products = $category->no_of_products;
        $sproducts = Product::where('sale_price','>',0)->inRandomOrder()->get()->take(8);
        $sale = Sale::find(1);

        return view('livewire.home-component',['sliders'=>$sliders,'lproducts'=>$lproducts,
                        'no_of_products'=>$no_of_products,'categories'=>$categories,
                        'sproducts' =>$sproducts,'sale' =>$sale])->layout('layouts.base');
    }
}
