<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ArticleController extends Controller implements HasMiddleware
{

public static function middleware()
    {
        return [
            new Middleware('permission:Show', only: ['index']),
            new Middleware('permission:Add', only: ['create', 'store']),
            new Middleware('permission:Edit', only: ['edit', 'update']),
            new Middleware('permission:Delete', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::latest()->paginate(10);
        return view('article.list', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('article.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:5',
            'author' => 'required|min:3',
        ]);

        if ($validator->passes()) {
            $article = new Article();
            $article->title = $request->title;
            $article->text = $request->text;
            $article->author = $request->author;
            $article->save();
            return redirect()->route('article.index')->with('success', 'Article added successfully');
        } else {
            return redirect()->route('article.create')
                ->withInput()
                ->withErrors($validator);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article = Article::findOrFail($id);
        return view('article.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:5',
            'author' => 'required|min:3',
        ]);

        if ($validator->passes()) {
            $article = Article::findOrFail($id);
            $article->title = $request->title;
            $article->text = $request->text;
            $article->author = $request->author;
            $article->save();
            return redirect()->route('article.index')->with('success', 'Article updated successfully');
        } else {
            return redirect()->route('article.edit', $id)
                ->withInput()
                ->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $article = Article::findOrFail($id);
        if (!$article) {
            Session::flash('error', 'Article not found');
            return response()->json(['status' => false]);
        }
        $article->delete();
        Session::flash('success', 'Article deleted successfully');
        return response()->json(['status' => true, 'message' => 'Article deleted successfully']);
    }
}
