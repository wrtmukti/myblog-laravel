<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::get()->all();
        $articles = Article::get()->where('public', 2);
        
        return view('home', compact('articles', 'users'));
    }
}
