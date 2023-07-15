@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h4>{{$article->title}}'s details</h4>
                <hr>
            </div>
            <div class="col-12 mb-3">
                <a href="{{route('article.create')}}" class="btn btn-outline-dark">Create</a>
                <a href="{{route('article.index')}}" class="btn btn-outline-dark">All articles</a>
            </div>
            <div class="col-12">
                <h4 class="mb-3">{{$article->title}}</h4>
                <div class="description">
                    {{$article->description}}
                </div>
            </div>
        </div>
    </div>
@endsection
