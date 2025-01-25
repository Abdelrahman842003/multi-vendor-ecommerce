<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Interface\Dashboard\ProductInterface;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function __construct(private ProductInterface $interfaceProduct)
    {
    }

    public function index()
    {
        return $this->interfaceProduct->index();
    }

    public function create()
    {
        return $this->interfaceProduct->create();
    }

    public function show($id)
    {
        return $this->interfaceProduct->show($id);
    }

    public function store(ProductRequest $request)
    {
        return $this->interfaceProduct->store($request);
    }

    public function edit($id)
    {
        return $this->interfaceProduct->edit($id);
    }

    public function update(ProductRequest $request, $id)
    {
        return $this->interfaceProduct->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->interfaceProduct->destroy($id);
    }

    public function trash()
    {
        return $this->interfaceProduct->trash();
    }

    public function restore($id)
    {
        return $this->interfaceProduct->restore($id);
    }

    public function forceDelete($id)
    {
        return $this->interfaceProduct->forceDelete($id);
    }
}
