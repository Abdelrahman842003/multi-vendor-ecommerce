@extends('dashboard.layout.index')
@section('title','edit store')
@section('breadcrumb','Store / Edit')
@section('content')

    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="main-content-label mg-b-5">
                        Create Store
                    </div>
                    <a href="{{ route('dashboard.store.index') }}" class="btn btn-secondary">Back</a>
                </div>
                <form class="mt-4" action="{{ route('dashboard.product.update', $product_id->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div id="wizard1">
                        <div class="control-group form-group">
                            <x-dashboard.input :type="'input'" :name="'name'" :placeholder="'Name'" :value="$product_id->name" :label="'Name'"/>
                        </div>
                        <div class="control-group form-group">
                            <x-dashboard.textarea name="description" :value="$product_id->description" placeholder="Description" label="Description"/>
                        </div>
                        <div class="control-group form-group">
                            <x-dashboard.input :type="'file'" :name="'image'" :placeholder="'Image'" :label="'Image'"/>
                        </div>
                        <div class="control-group form-group">
                            <x-dashboard.select
                                :name="'category_id'"
                                :options="$categories->pluck('name', 'id')->prepend('No Category', '')"
                                :value="$product_id->category_id"
                                :label="'Select Category'"
                            />
                        </div>
                        <div class="control-group form-group">
                            <x-dashboard.input :type="'input'" :name="'tags'" :placeholder="'Tags Product'" :value="$tags" :label="'Tags'"/>
                        </div>
                        <div class="control-group form-group">
                            <x-dashboard.input :type="'number'" :name="'price'" :placeholder="'Price Product'" :value="$product_id->price" :label="'Price'"/>
                        </div>
                        <div class="control-group form-group">
                            <x-dashboard.input :type="'number'" :name="'compare_price'" :placeholder="'Compare Price Product'" :value="$product_id->compare_price" :label="'Compare Price Product'"/>
                        </div>
                        <div class="control-group form-group">
                            <x-dashboard.select
                                :name="'featured'"
                                :options="[0 => 'No', 1 => 'Yes']"
                                :value="$product_id->featured"
                                :label="'Featured Product'"
                            />
                        </div>
                        <div class="control-group form-group">
                            <x-dashboard.select
                                :name="'status'"
                                :options="['active' => 'Active', 'draft' => 'Draft', 'archived' => 'Archived']"
                                :value="$product_id->status"
                                :label="'Status Product'"
                            />
                        </div>
                        <div class="control-group form-group">
                            <x-dashboard.input :type="'number'" :name="'rating'" :placeholder="'Rating Product'" :value="$product_id->rating" :label="'Rating Product'"/>
                        </div>
                        <div class="d-flex justify-content-around mt-4">
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <script>
        var inputElem = document.querySelector('[name="tags"]') // the 'input' element which will be transformed into a Tagify component
        var tagify = new Tagify(inputElem)
    </script>
@endpush
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
@endpush
