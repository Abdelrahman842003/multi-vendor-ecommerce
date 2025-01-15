@extends('dashboard.layout.index')
@section('title','category trash')
@section('breadcrumb','Category / Trash')
@section('content')
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="col-auto">
                        <a href="{{ route('dashboard.category.index') }}" class="btn btn-primary-gradient">Back</a>
                    </div>

                    <form action="{{ route('dashboard.category.trash') }}" method="GET">
                        <div class="input-group">
                            <input
                                class="form-control mr-2"
                                name="name"
                                placeholder="Search by name..."
                                type="search"
                            >
                            <div class="input-group-append">
                                <x-dashboard.select
                                    name="status"
                                    :options="[
                                        '' => 'All',
                                        'active' => 'Active',
                                        'archived' => 'Archived',
                                    ]"
                                    :value="old('status')"
                                    class="form-control  mr-2"
                                />
                            </div>
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 text-md-nowrap">
                        <thead>
                        <tr>
                            <th>Parent Category</th>
                            <th>Parent Store</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($categoriesTrash as $category)
                            <tr>
                                @if($category->parent_category_name != null)
                                    <td>{{$category->parent_category_name}}</td>
                                @else
                                    <td class="text-danger">No Parent</td>
                                @endif
                                @if($category->parent_store_name != null)
                                    <td>{{$category->parent_store_name}}</td>
                                @else
                                    <td class="text-danger">No Store</td>
                                @endif
                                <td>{{$category->name}}</td>
                                <td>{{$category->slug}}</td>
                                <td>{{$category->description}}</td>
                                <td>
                                    @if( $category->image != null)
                                        <img src="{{ asset('storage/attachments/'.$category->image ) }}"
                                             alt="{{ $category->cover_image }}" class="rounded-circle" width="50"
                                             height="50">

                                    @else
                                        <span class="text-danger">●</span>    <span>No Image</span>
                                    @endif
                                </td>

                                <td>
                                    @if ($category->status == 'active')
                                        <span class="text-success">●</span> Active
                                    @else
                                        <span class="text-danger">●</span> Archived
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('dashboard.category.restore', $category->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-primary" title="Restore">
                                            <i class="fas fa-undo"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('dashboard.category.forceDelete', $category->id) }}"
                                          method="POST"
                                          style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete"
                                                onclick="return confirm('Are you sure you want to delete this item?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No data available</td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
