<?php

namespace App\Http\Controllers\Users;


use App\Http\Requests\LTI\UpdateProfileRequest;
use App\Http\Controllers\Controller;

class ProfileController extends Controller {

    public function index() {
        return view('nonlti.users.profile', ['data' => auth()->user()]);
    }

    public function update(UpdateProfileRequest $request) {
        $user = auth()->user();

        $user->name = $request->get('name', $user->name);
        $user->email = $request->get('email', $user->email);

        if($request->get('new-password')) {
            $user->password = bcrypt($request->get('new-password'));
        }

        $user->save();
        session()->flash('success_message', 'Profile updated.');

        return redirect()->back();

    }

}
