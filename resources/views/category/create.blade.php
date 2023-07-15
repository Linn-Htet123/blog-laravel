@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>create new category</h3>
                <hr>
            </div>
            <div class="col-12">
                <form action="{{route('category.store')}}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label class=" form-label" for="">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title">
                        @error('title')
                        <div class=" invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <button class=" btn btn-primary">Create category</button>
                </form>
            </div>
        </div>
    </div>

@endsection
