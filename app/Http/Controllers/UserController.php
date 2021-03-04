<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index($id)
    {
        if ($id == Auth::user()->id){
            $users = User::findOrFail($id);
            return view('user.dashboard', compact( 'users'));
        }

        return redirect()->back(); 
    }
}
