@extends('dashboard.layout.index')
@section('title','edit category')
@section('breadcrumb','Category / Edit')
@section('content')

    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="main-content-label mg-b-5">
                        Create Category
                    </div>
                    <a href="{{ route('dashboard.category.index') }}" class="btn btn-secondary">Back</a>
                </div>

                <form class="mt-4" action="{{ route('dashboard.category.update', $category->id) }}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div id="wizard1">
                        <div class="control-group form-group">
                            <x-dashboard.input :type="'input'" :name="'name'" :placeholder="'Name'"
                                               :value="$category->name "
                                               :label="'Name'"/>
                        </div>
                        <div class="control-group form-group">
                            <x-dashboard.textarea name="description" :value="$category->description "
                                                  placeholder="Description" label="Description"/>
                        </div>
                        <div class="control-group form-group">
                            <x-dashboard.input :type="'file'" :name="'image'" :placeholder="'Image'"
                                               :value="$category->image"
                                               :label="'Image'"/>
                        </div>
                        <div class="control-group form-group">
                            <x-dashboard.select
                                :name="'store_id'"
                                :options="$stores->pluck('name', 'id')"
                                :value="$category->store_id"
                                :label="'Parent Store'"
                            />
                        </div>
                        <div class="control-group form-group">
                            <x-dashboard.select
                                :name="'parent_id'"
                                :options="$category_id->pluck('name', 'id')->prepend('No Parent', '')"
                                :value="$category->parent_id"
                                :label="'Parent Category'"
                            />
                        </div>
                        <div class="control-group form-group">
                            <x-dashboard.select
                                :name="'status'"
                                :options="[
                                    'active' => 'Active',
                                    'archived' => 'Archived',
                                ]"
                                :value="$category->status"
                                :label="'Status'"
                            />
                        </div>
                        <div class="d-flex justify-content-around mt-4">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
