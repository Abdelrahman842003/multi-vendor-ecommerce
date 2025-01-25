<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Interface\Dashboard\StoreInterface;
use App\Http\Requests\StoreRequest;

class StoreController extends Controller
{
    public function __construct(protected StoreInterface $interfaceStore){}


    public function index()
    {
        return $this->interfaceStore->index();

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->interfaceStore->create();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        return $this->interfaceStore->store($request);
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
        return $this->interfaceStore->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, string $id)
    {
        return $this->interfaceStore->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->interfaceStore->destroy($id);
    }

    public function trash()
    {
        return $this->interfaceStore->trash();
    }

    public function restore($id)
    {
        return $this->interfaceStore->restore($id);
    }

    public function forceDelete($id)
    {
        return $this->interfaceStore->forceDelete($id);
    }
}
