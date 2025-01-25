<?php
namespace App\Http\Interface\Dashboard;
interface StoreInterface{
    public function index();
    public function create();
    public function show($id);
    public function store($request);
    public function edit($id);
    public function update($request,$id);
    public function destroy($id);
    public function trash();
    public function restore($id);
    public function forceDelete($id);
}
