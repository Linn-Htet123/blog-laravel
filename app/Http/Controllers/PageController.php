<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index()
    {
        $articles = Article::when(request()->has("keyword"),function($query){
           $query->where(function(Builder $query){
               $keyword = request()->keyword;
               $query->where("title","like","%".$keyword."%");
               $query->orWhere("description","like","%".$keyword."%");
           });
        })
            ->when(request()->has('category'),function($query){
            $query->where("category_id",request()->category);
        })
            ->when(request()->has('name'),function($query){
                $sortType = request()->name ?? 'asc';
                $query->orderBy("title",$sortType);
            })
            ->latest('id')
            ->paginate(7)->withQueryString();
        return view('welcome',compact('articles'));
    }

    public function show($slug)
    {
        $article = Article::where('slug',$slug)->firstOrFail();
       return view('show',compact('article'));
    }
    public function categorized($slug)
    {
        $category = Category::where('slug',$slug)->firstOrFail();
        $articles = $category->articles()->when(request()->has("keyword"),function($query){
                $keyword = request()->keyword;
                $query->where("title","like","%".$keyword."%");
                $query->orWhere("description","like","%".$keyword."%");
            })->paginate(10)->withQueryString();
        return view('categorized', [
            'articles' => $articles,
            'category' => $category,
        ]);
    }
}
