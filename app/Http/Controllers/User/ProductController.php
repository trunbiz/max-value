<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Traits\BaseControllerTrait;
use function redirect;
use function view;

class ProductController extends Controller
{
    use BaseControllerTrait;

    public function __construct(Product $model)
    {
        $this->initBaseModel($model);
        $this->shareBaseModel($model);
    }

    public function index()
    {
        return view('user.' . $this->prefixView . '.index');
    }

}
