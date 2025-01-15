<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Http\Traits\AttachFilesTrait;
use App\Models\Profile;
use App\Models\User;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;


class ProfileController extends Controller
{
    use AttachFilesTrait;

    public function edit()
    {
        $languages = Languages::getNames();
        $countries = Countries::getNames();

        $auth_user = auth()->user();
        $user = User::with('profile')->where('id', $auth_user->id)->first();
        return view('dashboard.pages.user.profile', compact('user', 'languages', 'countries'));
    }

    public function update(ProfileRequest $request)
    {
        $validated = $request->validated();


        if ($request->hasFile('photo')) {
            $validated['photo'] = $this->uploadFile($request, 'photo', 'image_profile');
        }


        $profile = auth()->user()->profile;
        $profile->fill($validated)->save();
        toastr()->success('Profile updated successfully.');

        return view('dashboard.dashboard');
    }

}
