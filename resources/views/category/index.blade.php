@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h4>Articles</h4>
                <hr>
            </div>
            <div class="col-12 d-flex justify-content-between">
                <a href="{{route('article.create')}}" class="btn btn-outline-dark">Create</a>
                <form action="">
                    <div class="input-group">
                        <input type="text" name="keyword" class="form-control" value="{{request()->keyword??''}}">
                        <button class="btn btn-outline-dark">Search</button>
                    </div>
                </form>
            </div>
            <div class="col-12">
            <table class=" table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>
                        Title
                        <div class="btn-group">
                            <a class="ms-4 btn btn-sm btn-outline-dark" href="{{ route('article.index',["name"=>"asc"]) }}"><i class="bi bi-arrow-up"></i></a>
                            <a class="btn btn-sm btn-outline-dark" href="{{ route('article.index',["name"=>'desc']) }}"><i class="bi bi-arrow-down"></i></a>
                            <a class="btn btn-sm btn-outline-dark" href="{{ route('article.index') }}"><i class="bi bi-arrow-counterclockwise"></i></a>
                        </div>
                    </th>
                    <th>Description</th>
                    <th>Created by</th>
                    <th>Control</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($articles as $article)
                    <tr>
                        <td>{{ $article->id }}</td>
                        <td>{{ $article->title }}</td>
                        <td>{{ Str::limit($article->description, 30, '...') }}</td>
                        <td>{{$article->user_id}}</td>
                        <td>
                           <div class="btn-group">
                               <a class=" btn btn-sm btn-outline-dark" href="{{ route('article.show', $article->id) }}">
                                   <i class="bi bi-info"></i>
                               </a>
                               <a href="{{ route('article.edit', $article->id) }}" class="btn btn-sm btn-outline-dark">
                                   <i class="bi bi-pen-fill"></i>
                               </a>
                               <button class=" btn btn-sm btn-outline-dark" form="articleDeleteForm{{$article->id}}">
                                   <i class="bi bi-trash"></i>
                               </button>
                           </div>
                            <form id="articleDeleteForm{{$article->id}}" class=" d-inline-block" action="{{ route('article.destroy', $article->id) }}" method="post">
                                @method('delete')
                                @csrf

                            </form>
                        </td>
                        <td>{{$article->created_at->diffforhumans()}}</td>
                        <td>{{$article->updated_at->format('d M Y, h:i a')}}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="bg-light text-center">
                            <p>
                                There is no record
                            </p>
                            <a class=" btn btn-sm btn-primary" href="{{ route('article.create') }}">Create Item</a>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            {{ $articles->onEachSide(1)->links() }}

            </div>
        </div>
    </div>
@endsection
