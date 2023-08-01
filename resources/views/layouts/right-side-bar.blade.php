<div class="position-sticky" style="top: 80px">
    <form action="">
        <div class="input-group">
            <input type="text" name="keyword" class="form-control" value="{{request()->keyword??''}}">
            @if(request()->keyword)
                <a href="{{route('page.index')}}" class="btn btn-outline-danger">
                    <i class="bi bi-trash-fill"></i>
                </a>
            @endif
            <button class="btn btn-outline-dark">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </form>
    <ul class="list-group my-4">
        <h4>Sorted by</h4>
        <li class="list-group-item"><a href="{{route('page.index')}}" class="text-black text-decoration-none">All category</a></li>
        @forelse(App\Models\Category::all() as $category)
            <li class="list-group-item {{(request()->segment(2)) && ($category->slug == request()->segment(2)) ? 'bg-black' : '' }}" aria-current="true"><a href="{{route('page.categorized',['slug'=>$category->slug])}}" class="{{(request()->segment(2)) && ($category->slug == request()->segment(2)) ? 'text-white' : 'text-black' }} text-decoration-none">{{$category->title}}</a></li>
        @empty
            <li class="list-group-item">No category</li>
        @endforelse
    </ul>
    <ul class="list-group my-4">
        <h4>Most updated</h4>
        @forelse(App\Models\Article::latest('id')->limit(5)->get() as $article)
            <li class="list-group-item" aria-current="true"><a href="{{route('page.show',['slug'=>$article->slug])}}" class="text-decoration-none text-black">{{$article->title}}</a></li>
        @empty
            <li class="list-group-item">No article</li>
        @endforelse
    </ul>

</div>
