<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    //
    public function index(){
        $user = Auth::user();
        return view('profile.setting', compact('user'));
    }


    // ...
    public function update(ProfileRequest $profile_request , AddressRequest $address_request){
        $user = Auth::user();
        if($profile_request->hasFile('image')){

            if($user->image){
                Storage::delete('public/profile/' . $user->image);
            }

            $image_path = $profile_request->file('image')->store('public/profile');
            $image_name = basename($image_path);
        } else {
            $image_name = $user->image;
        }
        $user->update([
            'name' => $address_request->name,
            'postcode' => $address_request->postcode,
            'address' => $address_request->address,
            'building' => $address_request->building,
            'image' => $image_name,
        ]);
        return redirect('/mypage');
    }
}
