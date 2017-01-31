<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.list', compact('users'));
    }

    public function delete($id)
    {
        User::destroy($id);
        return redirect()->to('/users');
    }
}
