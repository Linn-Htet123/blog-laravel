@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>Edit article</h3>
                <hr>
            </div>
            <div class="col-12">
                <form action="{{route('article.update',$article->id)}}" method="post">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label class=" form-label" for="">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{old('title',$article->title)}}">
                        @error('title')
                        <div class=" invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class=" form-label" for="">Category</label>
                        <select class="form-select @error('category') is-invalid @enderror" name="category">
                            @forelse(App\Models\Category::all() as $category)
                                <option value="{{$category->id}}" {{old('category',$article->category_id) == $category->id?'selected':''}}>
                                    {{$category->title}}
                                </option>
                            @empty
                                <option disabled>
                                    No category
                                </option>
                            @endforelse
                        </select>
                        @error('category')
                        <div class=" invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class=" form-label" for="">Description</label>
                        <textarea name="description" class=" form-control @error('description') is-invalid @enderror" rows="7">{{old('description',$article->description)}}</textarea>
                        @error('description')
                        <div class=" invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button class=" btn btn-primary">Edit article</button>
                </form>
            </div>
        </div>
    </div>

@endsection
