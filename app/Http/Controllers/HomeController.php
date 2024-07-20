<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;

class HomeController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;

        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $productData = [
            'product_total'       => $this->productRepository->totalProduct(),
            'product_aviable'     => $this->productRepository->cantProductAviable(),
            'inventory_value'     => $this->productRepository->totalInventoryValue(),
            'product_gross_margin'=> $this->productRepository->averageGrossMarginPerProduct(),
            'product_gross_profit'=> $this->productRepository->topGrossProfitProducts(),
            'product_below_min_qty'=> $this->productRepository->getProductsBelowMinQty(),
        ];
        // dump($this->productRepository->totalProduct());
        // dump($this->productRepository->cantProductAviable());
        // dump($this->productRepository->totalInventoryValue());
        // dump($this->productRepository->averageGrossMarginPerProduct()->toArray());
        // dump($this->productRepository->topGrossProfitProducts()->toArray());
        // dd($this->productRepository->getProductsBelowMinQty());
        // dd($productData);
        return view('home',compact('productData'));
    }
}
