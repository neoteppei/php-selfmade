<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function destroy(User $user)
    {
        
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'ユーザーを削除しました。');
    }
}
