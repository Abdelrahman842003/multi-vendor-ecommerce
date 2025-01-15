@php use App\Models\Store; @endphp
@extends('dashboard.layout.index')
@section('title','create')
@section('breadcrumb','Create')
@section('content')
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="col-auto">
                        <a href="{{ route('dashboard.store.create') }}" class="btn btn-primary-gradient">Add
                            Store</a>
                    </div>
                    @if($trash_count = Store::onlyTrashed()->count())
                        <div class="col-auto">
                            <a href="{{ route('dashboard.store.trash') }}" class="btn btn-danger">
                                Trash ({{ $trash_count }})
                            </a>
                        </div>
                    @endif
                    <form action="{{ route('dashboard.store.index') }}" method="GET">
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
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Description</th>
                            <th>Logo Image</th>
                            <th>Cover Image</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($stores as $store)
                            <tr>
                                @if($store->parent_name != null)
                                    <td>{{$store->parent_name}}</td>

                                @else
                                    <td class="text-danger">No Parent</td>

                                @endif
                                <td>{{$store->name}}</td>
                                <td>{{$store->slug}}</td>
                                <td>{{$store->description}}</td>
                                <td>
                                    @if( $store->logo_image != null)
                                        <img src="{{ asset('storage/attachments/'.$store->logo_image ) }}"
                                             alt="{{ $store->logo_image }}" class="rounded-circle" width="50"
                                             height="50">

                                    @else
                                        <span class="text-danger">●</span>    <span>No Image</span>
                                    @endif
                                </td>
                                <td>
                                    @if( $store->cover_image != null)
                                        <img src="{{ asset('storage/attachments/'.$store->cover_image ) }}"
                                             alt="{{ $store->cover_image }}" class="rounded-circle" width="50"
                                             height="50">

                                    @else
                                        <span class="text-danger">●</span>    <span>No Image</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($store->status == 'active')
                                        <span class="text-success">●</span> Active
                                    @else
                                        <span class="text-danger">●</span> Archived
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('dashboard.store.edit', $store->id) }}"
                                       class="btn btn-sm btn-primary"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('dashboard.store.destroy', $store->id) }}" method="POST"
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
