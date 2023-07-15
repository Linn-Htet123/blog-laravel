@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h4>Users</h4>
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
                            Name
                        </th>
                        <th>Email</th>
{{--                        <th>Control</th>--}}
                        <th>Created at</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{$user->email}}</td>
{{--                            <td>--}}
{{--                                <div class="btn-group">--}}
{{--                                    <a class=" btn btn-sm btn-outline-dark" href="{{ route('article.show', $user->id) }}">--}}
{{--                                        <i class="bi bi-info"></i>--}}
{{--                                    </a>--}}
{{--                                    <a href="{{ route('article.edit', $user->id) }}" class="btn btn-sm btn-outline-dark">--}}
{{--                                        <i class="bi bi-pen-fill"></i>--}}
{{--                                    </a>--}}
{{--                                    <button class=" btn btn-sm btn-outline-dark" form="articleDeleteForm{{$user->id}}">--}}
{{--                                        <i class="bi bi-trash"></i>--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                                <form id="articleDeleteForm{{$user->id}}" class=" d-inline-block" action="{{ route('article.destroy', $user->id) }}" method="post">--}}
{{--                                    @method('delete')--}}
{{--                                    @csrf--}}

{{--                                </form>--}}
{{--                            </td>--}}
                            <td>{{$user->created_at->format('d M Y, h:i a')}}</td>

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
                {{$users->onEachSide(1)->links()}}

            </div>
        </div>
    </div>
@endsection
