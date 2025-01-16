<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function index($id) {
        $user = User::find($id);
        return view('pages.profile.index', ['menu' => 'profile', 'data' => $user]);
    }

    public function update(Request $request)
    {
        $r = $request->all();
        try {
            $user = User::find($r['id']);
            if ($r['password'] != null) {
                $r['password'] = bcrypt($r['password']);
            } else {
                $r['password'] = $r['oldPassword'];
            }
    
            $user->update($r);
    
            return redirect()->route('dashboard')->with('message', 'update profile');
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
