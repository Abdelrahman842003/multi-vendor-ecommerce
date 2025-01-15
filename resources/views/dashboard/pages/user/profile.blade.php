@extends('dashboard.layout.index')
@section('title','user profile')
@section('breadcrumb','User / Profile')
@section('content')

    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="main-content-label mg-b-5">
                        Create Store
                    </div>
                    <a href="" class="btn btn-secondary">Back</a>
                </div>
                <form class="mt-4" action="{{ route('profile.update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="control-group form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    <div class="control-group form-group">
                        <x-dashboard.input
                            :type="'text'"
                            :name="'first_name'"
                            :placeholder="'First Name'"
                            :value="$user->profile->first_name"
                            :label="'First Name'"
                        />
                    </div>
                    <div class="control-group form-group">
                        <x-dashboard.input
                            :type="'text'"
                            :name="'last_name'"
                            :placeholder="'Last Name'"
                            :value="$user->profile->last_name"
                            :label="'Last Name'"
                        />
                    </div>
                    <div class="control-group form-group">
                        <x-dashboard.input
                            :type="'email'"
                            :name="'email'"
                            :placeholder="'Email'"
                            :value="$user->profile->user->email"
                            :label="'Email'"
                            :disabled="true"
                        />
                    </div>

                    <div class="control-group form-group">
                        <x-dashboard.input
                            :type="'date'"
                            :name="'date_of_birth'"
                            :value="$user->profile->date_of_birth"
                            :label="'Date of Birth'"
                        />
                    </div>
                    <div class="control-group form-group">
                        <x-dashboard.select
                            :name="'gender'"
                            :options="['male' => 'Male', 'female' => 'Female']"
                            :value="$user->profile->gender"
                            :label="'Gender'"
                        />
                    </div>
                    <div class="control-group form-group">
                        <x-dashboard.input
                            :type="'text'"
                            :name="'street_address'"
                            :placeholder="'Street Address'"
                            :value="$user->profile->street_address"
                            :label="'Street Address'"
                        />
                    </div>
                    <div class="control-group form-group">
                        <x-dashboard.input
                            :type="'text'"
                            :name="'city'"
                            :placeholder="'City'"
                            :value="$user->profile->city"
                            :label="'City'"
                        />
                    </div>
                    <div class="control-group form-group">
                        <x-dashboard.input
                            :type="'text'"
                            :name="'postal_code'"
                            :placeholder="'Postal Code'"
                            :value="$user->profile->postal_code"
                            :label="'Postal Code'"
                        />
                    </div>
                    <div class="control-group form-group">
                        <x-dashboard.input
                            :type="'text'"
                            :name="'address'"
                            :placeholder="'Address'"
                            :value="$user->profile->address"
                            :label="'Address'"
                        />
                    </div>
                    <div class="control-group form-group">
                        <x-dashboard.select
                            :name="'country'"
                            :options="$countries"
                            :value="$user->profile->country"
                            :label="'Country'"
                        />
                    </div>
                    <div class="control-group form-group">
                        <x-dashboard.select
                            :name="'locale'"
                            :options="$languages"
                            :value="$user->profile->locale"
                            :label="'Locale'"
                        />
                    </div>
                    <div class="control-group form-group">
                        <x-dashboard.input
                            :type="'text'"
                            :name="'phone'"
                            :placeholder="'Phone'"
                            :value="$user->profile->phone"
                            :label="'Phone'"
                        />
                    </div>
                    <div class="control-group form-group">
                        <x-dashboard.input
                            :type="'file'"
                            :name="'photo'"
                            :label="'Photo'"
                            accept="image/*"
                        />
                        @if($user->profile->photo != null)
                            <img src="{{ asset('storage/attachments/'.$user->profile->photo ) }}"
                                 alt="The Profile image" class="rounded-circle" width="50"
                                 height="50">
                        @else
                            <span class="text-danger">●</span> <span>No Image</span>
                        @endif
                    </div>


                </form>
            </div>
        </div>
    </div>

@endsection
