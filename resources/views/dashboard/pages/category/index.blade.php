@php use App\Models\Category; @endphp
@extends('dashboard.layout.index')
@section('title','category')
@section('breadcrumb','Category ')
@section('content')
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="col-auto">
                        <a href="{{ route('dashboard.category.create') }}" class="btn btn-primary-gradient">Add
                            Category</a>
                    </div>
                    @if($trash_count = Category::onlyTrashed()->count())
                        <div class="col-auto">
                            <a href="{{ route('dashboard.category.trash') }}" class="btn btn-danger">
                                Trash ({{ $trash_count }})
                            </a>
                        </div>
                    @endif
                    <form action="{{ route('dashboard.category.index') }}" method="GET">
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
                            <th>Products Count</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>
                                    @if($category->parent_id != null)
                                        {{$category->parent->name}}
                                    @else
                                        <span class="text-danger">No Parent</span>
                                    @endif
                                </td>
                                <td>
                                    @if($category->store_id != null)
                                        {{$category->store->name}}
                                    @else
                                        <span class="text-danger">No Store</span>
                                    @endif
                                </td>
                                <td>{{$category->name}}</td>
                                <td>{{ Str::limit($category->slug, 5) }}</td>
                                <td>
                                    @if($category->product_count == 0)
                                        <span class="text-danger">●</span> <span>No Products</span>
                                    @else
                                        <a href="{{ route('dashboard.product.index') }}">{{$category->product_count}}</a>
                                </td>
                                @endif
                                <td>{{ Str::limit($category->description, 5) }}</td>
                                <td>
                                    @if($category->image != null)
                                        <img src="{{ asset('storage/attachments/'.$category->image ) }}"
                                             alt="{{ $category->cover_image }}" class="rounded-circle" width="50"
                                             height="50">
                                    @else
                                        <span class="text-danger">●</span> <span>No Image</span>
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
                                    <a href="{{ route('dashboard.category.edit', $category->id) }}"
                                       class="btn btn-sm btn-primary"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('dashboard.category.destroy', $category->id) }}"
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
                                <td colspan="9" class="text-center">No data available</td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
