<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Address;
use App\Models\Country;
use App\Models\State;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $address = Address::where('user_id', $user->id)->first();
        $countries = Country::get()->toArray();
        $states = State::get()->toArray();
        
        return view('frontend.profile', compact('user', 'address', 'countries', 'states'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        // If password is provided, validate it
        if ($request->filled('password')) {
            $rules['password'] = 'required|string|min:6|confirmed';
        }

        // Validate address if they provided an address line 1
        if ($request->filled('address_line_1')) {
            $rules['address_line_1'] = 'required|string|max:255';
            $rules['country_id'] = 'required';
            $rules['state_id'] = 'required';
            $rules['city'] = 'required|string|max:255';
        }

        $request->validate($rules);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;

        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/avatars'), $imageName);
            
            // Delete old avatar if exists (optional but good practice)
            if ($user->avatar && file_exists(public_path($user->avatar))) {
                @unlink(public_path($user->avatar));
            }
            
            $user->avatar = 'uploads/avatars/' . $imageName;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        if ($request->filled('address_line_1')) {
            Address::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'address_line_1' => $request->address_line_1,
                    'address_line_2' => $request->address_line_2,
                    'country_id' => $request->country_id,
                    'state_id' => $request->state_id,
                    'city' => $request->city,
                    'pincode' => $request->pincode,
                ]
            );
        }

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
