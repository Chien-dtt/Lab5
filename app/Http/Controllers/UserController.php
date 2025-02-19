<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{

    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Bạn không có quyền truy cập trang này!');
        }

        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function edit()
    {
        return view('users.edit', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'avatar' => 'nullable|image|max:2048',
        ]);

        $user->fullname = $request->fullname;
        $user->username = $request->username;

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        // $user->save();

        return redirect()->route('dashboard')->with('success', 'Thông tin cập nhật thành công!');
    }
}
