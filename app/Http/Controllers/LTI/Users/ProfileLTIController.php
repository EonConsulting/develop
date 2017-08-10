<?php

namespace App\Http\Controllers\LTI\Users;

use App\Http\Requests\LTI\UpdateProfileRequest;
use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;

class ProfileLTIController extends LTIBaseController {

    public function index() {
        return view('lti.users.profile', ['data' => auth()->user()]);
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
