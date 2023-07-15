@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>create new article</h3>
                <hr>
            </div>
            <div class="col-12">
                <form action="{{route('article.store')}}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label class=" form-label" for="">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title">
                        @error('title')
                        <div class=" invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class=" form-label" for="">Category</label>
                        <select class="form-select @error('category') is-invalid @enderror" name="category">
                           @forelse(App\Models\Category::all() as $category)
                                <option value="{{$category->id}}" {{old('category') == $category->id?'selected':''}}>
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
                        <textarea name="description" class=" form-control @error('description') is-invalid @enderror" rows="7"></textarea>
                        @error('description')
                        <div class=" invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button class=" btn btn-primary">Create article</button>
                </form>
            </div>
        </div>
    </div>

@endsection
