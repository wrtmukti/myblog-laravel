<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class ArticleController extends Controller
{
    public function index($id)
    {
        if ($id == Auth::user()->id) {
            $articles = Article::get()->where('user_id', $id);
            return view('user.dashboard', compact('articles'));
        }
        return redirect()->back();
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'text' => 'required',
        ]);

        Article::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-'),
            'category' => $request->category,
            'text' => $request->text,
        ]);
        return redirect()->to('users/' . $request->user_id . '/' . 'dashboard/')->with('status', 'berhasil menambah data!');
    }

    public function show($user_id, Article $article)
    {
        //  dd($article);
        $articles = $article;
        // $comments = Comment::findOrFail($article->id);
        return view('user.show', compact('articles',));
    }

    public function public(Request $request, $id)
    {
        if ($id->Auth::user()->id) {
            Article::where('id', $request->id)
                ->update([
                    'public' => 2,
                ]);
            return redirect()->to('users/dashboard/' . $id)->with('status', 'berhasil mempublish data!');
        }
        return redirect()->back();
    }

    public function edit($user_id, Article $article)
    {
        // dd($article);
        return view('user.edit', compact('article'));
    }

    public function update(Request $request, $id,  Article $article)
    {
        //  dd($request);
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'text' => 'required',
        ]);
        Article::where([
            ['id', $request->id], //salah disini
            ['user_id', $id],
        ])->update([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'text' => $request->text,
            'public' => $request->public,
            'category' => $request->category,
        ]);
        return redirect()->to('users/' . $id . '/dashboard')->with('status', 'berhasil mengubah data!');
    }

    public function destroy($user_id, Article $article)
    {
        if (Auth::user()->id == $user_id) {
            Article::destroy($article->id);
            return redirect()->to('users/' . $user_id . '/dashboard')->with('status', 'berhasil menghapus post!');
        }  // return $student;

        return redirect()->back();
    }

    public function publish($user_id, Article $article)
    {

        // dd($article);
        Article::where('id', $article->id)
            ->update([
                'public' => 2,
            ]);
        return redirect()->to('users/' . $user_id . '/dashboard')->with('status', 'berhasil publish post!');
    }

    public function archive($user_id, Article $article)
    {

        //   dd($article);
        Article::where('id', $article->id)
            ->update([
                'public' => 0,
            ]);
        return redirect()->to('users/' . $user_id . '/dashboard')->with('status', 'berhasil mengarsip post!');
    }

    public function comment_store(Request $request, $user_id, Article $article)
    {
        // dd($article->id);
        Comment::where('id', $article->id)
            ->create([
                'user_id' => $user_id,
                'article_id' => $article->id,
                'text' => $request->text
            ]);
        return redirect()->to('users/' . $article->user->id . '/article/ ' . $article->id . '/show')->with('status', 'berhasil mengarsip post!');
    }
}
