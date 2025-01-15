@extends('dashboard.layout.index')
@section('title','create')
@section('breadcrumb','Create')
@section('content')
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="col-auto">
                        <a href="{{ route('dashboard.product.create') }}" class="btn btn-primary-gradient">Add
                            Product</a>
                    </div>
                    @if($trash_count = \App\Models\Product::onlyTrashed()->count())
                        <div class="col-auto">
                            <a href="{{ route('dashboard.product.trash') }}" class="btn btn-danger">
                                Trash ({{ $trash_count }})
                            </a>
                        </div>
                    @endif
                    <form action="{{ route('dashboard.product.index') }}" method="GET">
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
                            <th>Store</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Compare Price</th>
                            <th>Rating</th>
                            <th>Featured</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>
                                    {{$product->store->name}}
                                </td>
                                <td>
                                    @if($product->category_id != null)
                                        {{$product->category->name}}
                                    @else
                                        <span class="text-danger">No Category</span>
                                    @endif
                                </td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->slug}}</td>
                                <td>{{ Str::limit($product->description, 5) }}</td>
                                <td>
                                    @if( $product->image != null)
                                        <img src="{{ asset('storage/attachments/'.$product->image ) }}"
                                             alt="{{ $product->image }}" class="rounded-circle" width="50"
                                             height="50">

                                    @else
                                        <span class="text-danger">●</span>    <span>No Image</span>
                                    @endif
                                </td>
                                <td>{{$product->price}}</td>
                                <td>{{$product->compare_price}}</td>
                                <td>{{$product->rating}}</td>
                                <td>
                                    @if ($product->featured == 1)
                                        <span class="text-success">●</span> Yes
                                    @else
                                        <span class="text-danger">●</span> No
                                    @endif
                                </td>
                                <td>
                                    @if ($product->status == 'active')
                                        <span class="text-success">●</span> Active
                                    @else
                                        <span class="text-danger">●</span> Inactive
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('dashboard.product.edit', $product->id) }}"
                                       class="btn btn-sm btn-primary"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('dashboard.product.destroy', $product->id) }}" method="POST"
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
                                <td colspan="12" class="text-center">No data available</td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
