@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h4>{{$article->title}}'s details</h4>
                <hr>
            </div>
            <div class="col-12 mb-3">
{{--                <a href="{{route('article.create')}}" class="btn btn-outline-dark">Create</a>--}}
                <a href="{{route('page.index')}}" class="btn btn-outline-dark">All articles</a>
            </div>
            <div class="col-12">
                <h4 class="mb-3">{{$article->title}}</h4>
                <span class="badge bg-black">{{$article->category_id}}</span>
                <div class="description">
                    {{$article->description}}
                </div>

                @forelse($article->comment()->whereNull('parent_id')->latest('id')->get() as $comment)

                    <div class="bg-body-secondary p-3 my-2">
                       <div class="d-flex justify-content-between align-items-center">
                          <div class="">
                              <span class="text-white p-1 mb-0 badge bg-dark"><i class="bi bi-person"></i>{{$comment->user->name}}</span>
                              <span class="text-white badge bg-dark mb-2"><i class="bi bi-clock me-2"></i>{{$comment->created_at->diffforhumans()}}</span>
                          </div>
                           @can('forceDelete',$comment)
                               <div class="">
                                   <form action="{{route('comment.destroy',$comment->id)}}" method="post">
                                       @csrf
                                       @method('delete')
                                       <button class="badge bg-dark text-white"><i class="bi bi-trash-fill"></i></button>
                                   </form>
                               </div>
                           @endcan
                       </div>
                       <div class="d-flex">
                               <i class="bi bi-chat-left-dots-fill mx-3"></i>
                               <span class="fs-4">{{$comment->comment}}</span>
                       </div>
                        @auth
                            <div class="text-decoration-underline text-black ms-5 reply-btn user-select-none" style="cursor:pointer">
                                <i class="bi bi-reply"></i> reply
                            </div>
                            <div class="reply my-3 ms-5 d-none">
                                <span class="fw-bold">Reply {{$comment->user->name}}'s comment</span>
                                <form action="{{route('comment.store')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="article_id" value="{{$article->id}}">
                                    <input type="hidden" name="parent_id" value="{{$comment->id}}">
                                    <textarea name="comment" class="form-control" rows="4" placeholder="reply comment..."></textarea>
                                    @error('content') <span class="text-danger">{{$message}}</span> @enderror
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p>Reply as {{\Illuminate\Support\Facades\Auth::user()->name}}</p>
                                        <button class="btn btn-dark my-2">Reply</button>
                                    </div>
                                </form>
                            </div>
                        @endauth
                        <div class="reply-comment ms-5 ps-4">
                            @foreach($comment->replies()->latest('id')->get() as $reply)
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="">
                                        <span class="text-white p-1 mb-0 badge bg-dark"><i class="bi bi-person"></i>{{$reply->user->name}}</span>
                                        <span class="text-white badge bg-dark mb-2"><i class="bi bi-clock me-2"></i>{{$reply->created_at->diffforhumans()}}</span>
                                    </div>
                                    @can('forceDelete',$reply)
                                        <div class="">
                                            <form action="{{route('comment.destroy',$reply->id)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="badge bg-dark text-white"><i class="bi bi-trash-fill"></i></button>
                                            </form>
                                        </div>
                                    @endcan
                                </div>
                                <div class="d-flex">
                                    <i class="bi bi-chat-left-dots-fill mx-3"></i>
                                    <span class="fs-4">{{$reply->comment}}</span>
                                </div>
                            @endforeach
                        </div>

                    </div>
                @empty
                    <div class="bg-body-secondary p-5">no comment</div>
                @endforelse

                @auth
                    <div class="comment my-3">
                        <h4>Comment</h4>
                        <form action="{{route('comment.store')}}" method="post">
                            @csrf
                            <input type="hidden" name="article_id" value="{{$article->id}}">
                            <textarea name="comment" class="form-control" rows="4" placeholder="comment..."></textarea>
                            @error('content') <span class="text-danger">{{$message}}</span> @enderror
                            <div class="d-flex justify-content-between align-items-center">
                                <p>Comment as {{\Illuminate\Support\Facades\Auth::user()->name}}</p>
                                <button class="btn btn-dark my-2">comment</button>
                            </div>
                        </form>
                    </div>
                @endauth
            </div>
        </div>
    </div>
@endsection
@vite('resources/js/reply.js')
