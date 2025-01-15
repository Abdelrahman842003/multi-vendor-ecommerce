@extends('dashboard.layout.index')
@section('title','create store')
@section('breadcrumb','Store / Create')
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
                <form class="mt-4" action="{{ route('dashboard.store.store') }}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div id="wizard1">
                        <div class="control-group form-group">
                            <x-dashboard.input :type="'input'" :name="'name'" :placeholder="'Name'" :label="'Name'"/>

                        </div>
                        <div class="control-group form-group">
                            <x-dashboard.textarea name="description"  placeholder="Description" label="Description"/>

                        </div>
                        <div class="control-group form-group">
                            <x-dashboard.input :type="'file'" :name="'logo_image'" :placeholder="'Logo Image'" :label="'Logo Image'"/>

                        </div>
                        <div class="control-group form-group">
                            <x-dashboard.input :type="'file'" :name="'cover_image'" :placeholder="'Cover Image'"  :label="'Cover Image'"/>

                        </div>
                        <div class="control-group form-group">
                            <x-dashboard.select
                                :name="'parent_id'"
                                :options="$stores->pluck('name', 'id')->prepend('No Parent', '')"
                                :label="'Parent Store'"
                            />

                        </div>
                        <div class="control-group form-group">
                            <x-dashboard.select
                                :name="'status'"
                                :options="[
                                    'active' => 'Active',
                                    'archived' => 'Archived',
                                ]"
                                :value="old('status')"
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
