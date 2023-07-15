@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h4>Categories</h4>
                <hr>
            </div>
            <div class="col-12 d-flex justify-content-between">
                <a href="{{route('category.create')}}" class="btn btn-outline-dark">Create</a>
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
                            <a class="ms-4 btn btn-sm btn-outline-dark" href="{{ route('category.index',["name"=>"asc"]) }}"><i class="bi bi-arrow-up"></i></a>
                            <a class="btn btn-sm btn-outline-dark" href="{{ route('category.index',["name"=>'desc']) }}"><i class="bi bi-arrow-down"></i></a>
                            <a class="btn btn-sm btn-outline-dark" href="{{ route('category.index') }}"><i class="bi bi-arrow-counterclockwise"></i></a>
                        </div>
                    </th>
                    <th>Created by</th>
                    <th>Control</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->title }}</td>
                        <td>{{$category->user_id}}</td>
                        <td>
                           <div class="btn-group">
                               <a href="{{ route('category.edit', $category->id) }}" class="btn btn-sm btn-outline-dark">
                                   <i class="bi bi-pen-fill"></i>
                               </a>
                               <button class=" btn btn-sm btn-outline-dark" form="categoryDeleteForm{{$category->id}}">
                                   <i class="bi bi-trash"></i>
                               </button>
                           </div>
                            <form id="categoryDeleteForm{{$category->id}}" class=" d-inline-block" action="{{ route('category.destroy', $category->id) }}" method="post">
                                @method('delete')
                                @csrf

                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="bg-light text-center">
                            <p>
                                There is no record
                            </p>
                            <a class=" btn btn-sm btn-primary" href="{{ route('category.create') }}">Create Category</a>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            {{ $categories->onEachSide(1)->links() }}

            </div>
        </div>
    </div>
@endsection
