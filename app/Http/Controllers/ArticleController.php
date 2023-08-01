<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $articles = Article::when(request()->has("keyword"),function($query){
           $query->where(function(Builder $query){
               $keyword = request()->keyword;
               $query->where("title","like","%".$keyword."%");
               $query->orWhere("description","like","%".$keyword."%");
           });
        })
            ->when(Auth::user()->role == 'user',function($query){
                $query->where("user_id",Auth::id());
            })
            ->when(request()->has('name'),function($query){
                $sortType = request()->name ?? 'asc';
                $query->orderBy("title",$sortType);
            })
            ->latest('id')
            ->paginate(7)->withQueryString();
        return view('article.index',compact('articles'));
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
    public function store(StoreArticleRequest $request)
    {
        $article = Article::create([
            'title'=>$request->title,
            'description' => $request->description,
            'category_id' => $request->category,
            'user_id' => Auth::id(),
        ]);
        return redirect()->route('article.index')->with(['message'=>$article->title.'added successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view('article.show',compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $this->authorize('update',$article);
        return view('article.edit',compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
//        if(!Gate::allows('article-update',$article)){
//            abort(403,"you can't update this becoz you are bull shit");
//        }
//        if (Gate::denies('article-update',$article)){
//            abort(403,'No way');
//        }
        $this->authorize('update',$article);
       $article->update([
           'title' => $request->title,
           'description' => $request->description,
           'category_id' => $request->category,
           'user_id' => Auth::id(),
         ]);
        return redirect()->route('article.index')->with(['message'=>$article->title.'updated successfully']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $this->authorize('delete',$article);
        $article->delete();
        return redirect()->route('article.index')->with(['message'=>$article->title.'deleted successfully']);
    }
}
