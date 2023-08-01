@extends('layouts.master')
@section('content')

        @if(request()->keyword)
            <h4>search by:{{request()->keyword}}</h4>
        @endif
        @forelse($articles as $article)
            <div class="card mb-3">
                <div class="card-body">
                    <a href="{{route('page.show',$article->slug)}}" class=" text-decoration-none">
                        <h3 class="text-black">{{$article->title}}</h3>
                        <span class="small text-black-50">{{$article->created_at->diffforhumans()}}</span>
                    </a>
                    <div class="d-flex mb-3">
                        <span class="badge bg-dark">{{$article->category?->title}}</span>
                        <span class="badge mx-2 bg-dark">{{$article->user->name}}</span>
                    </div>
                    <p>
                        {{$article->excerpt}}
                        <a href="{{route('page.show',$article->slug)}}" class="link-underline mx-1 text-black">See more</a>
                    </p>
                </div>
            </div>
        @empty
            <div class="bg-body-secondary p-5 w-100">
                <div class="card-body d-flex align-items-center justify-content-center flex-column">
                    <h3>No article yet</h3>
                    <a href="{{route('article.create')}}" class="text-black-50">create</a>
                </div>
            </div>
        @endforelse


    <div class="col-lg-8 my-3">
        {{$articles->onEachSide(1)->links()}}
    </div>
@endsection
