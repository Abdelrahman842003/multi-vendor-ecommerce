<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Interface\CategoryInterface;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(protected CategoryInterface $interfaceCategory)
    {
    }

    public function index()
    {
        return $this->interfaceCategory->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->interfaceCategory->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        return $this->interfaceCategory->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->interfaceCategory->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        return $this->interfaceCategory->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->interfaceCategory->destroy($id);
    }

    public function trash()
    {
        return $this->interfaceCategory->trash();
    }

    public function restore($id)
    {
        return $this->interfaceCategory->restore($id);
    }

    public function forceDelete($id)
    {
        return $this->interfaceCategory->forceDelete($id);
    }

}
