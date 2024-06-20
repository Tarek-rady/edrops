<?php

namespace App\Http\Controllers\Saller;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Repositories\Sql\SallerRepository;
use App\Repositories\Sql\ProductRepository;
use App\Repositories\Sql\CategoryRepository;
use App\Repositories\Sql\CountryRepository;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Search\ProductSearch\ProductSearch;

class ProductCatalogController extends Controller
{
    protected $sallerRepo, $productRepo, $categoryRepo, $countryRepo;

    private $limit    = 12;

    public function __construct(
        SallerRepository $sallerRepo,
        ProductRepository $productRepo,
        CategoryRepository $categoryRepo,
        CountryRepository $countryRepo)
    {

        $this->sallerRepo = $sallerRepo ;
        $this->productRepo = $productRepo;
        $this->categoryRepo = $categoryRepo;
        $this->countryRepo = $countryRepo;
    }


    public function products()
    {
        $seller = auth('admin')->user()->saller;

        $products = $this->productRepo->query()->whereHas('sallers', function($query) use ($seller){
            return $query->where('saller_id', $seller->id)->where('saller_products.type', 'products');
        })->paginate($this->limit);
        $categories = $this->categoryRepo->getAll();
        $countries = $this->countryRepo->getAll();

        return view('dashboard.saller.products_catalog.index', compact('products', 'categories', 'countries'));
    }


    public function filter_products(Request $request)
    {
        $pageNumber = $request->page ?? 1;

        $products = ProductSearch::apply($request)->paginate($this->limit, ['*'], 'page', $pageNumber);

        return response()->json([
            'html' => view('dashboard.saller.products_catalog._response', compact('products'))->render(),
            'filters' => $request->input()
        ]);
    }


}
