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
                <form class="mt-4" action="{{ route('dashboard.store.update', $store_id->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div id="wizard1">
                        <div class="control-group form-group">
                            <x-dashboard.input
                                :type="'text'"
                                :name="'name'"
                                :placeholder="'Name'"
                                :value="$store_id->name"
                                :label="'Name'"
                                />
                        </div>
                        <div class="control-group form-group">
                            <x-dashboard.textarea
                                :name="'description'"
                                :value=" $store_id->description"
                                :placeholder="'Description'"
                                :label="'Description'"
                                />
                        </div>
                        <div class="control-group form-group">
                            <x-dashboard.input
                                :type="'file'"
                                :name="'logo_image'"
                                :label="'Logo Image'"
                                accept="image/*"/>
                        </div>
                        <div class="control-group form-group">
                            <x-dashboard.input
                                :type="'file'"
                                :name="'cover_image'"
                                :label="'Cover Image'"
                                accept="image/*"/>
                        </div>
                        <div class="control-group form-group">
                            <x-dashboard.select
                                :name="'parent_id'"
                                :options="$stores->pluck('name', 'id')->prepend('No Parent', '')"
                                :value=" $store_id->parent_id"
                                :label="'Parent Store'"
                                />
                        </div>
                        <div class="control-group form-group">
                            <x-dashboard.select
                                :name="'status'"
                                :options="['active' => 'Active', 'archived' => 'Archived']"
                                :value="$store_id->status"
                                :label="'Status'"
                                />
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
