<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(){
        $user = Auth::user();
        if(session()->has('logged_in') && session('logged_in') === true){
            session()->forget('logged_in');
            return redirect('/');
        }
        return view('profile.setting', compact('user'));
    }

    public function update(ProfileRequest $profileRequest , AddressRequest $addressRequest){
        $user = Auth::user();
        if($profileRequest->hasFile('image')){
            if($user->image){
                Storage::delete('public/profile/' . $user->image);
            }
            $imagePath = $profileRequest->file('image')->store('profile', 'public');
            $imageName = basename($imagePath);
        } else {
            $imageName = $user->image;
        }
        $user->update([
            'name' => $addressRequest->name,
            'postcode' => $addressRequest->postcode,
            'address' => $addressRequest->address,
            'building' => $addressRequest->building,
            'image' => $imageName,
        ]);
        return redirect('/mypage');
    }
}
