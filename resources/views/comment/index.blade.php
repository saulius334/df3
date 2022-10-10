@extends('layouts.app')

@section('content')
<div class="container --content">
    <div class="row justify-content-center">
        <div class="col-9">
            <div class="card">
                <div class="card-header">
                    <h2>Categories</h2>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($movies as $movies)
                        <li class="list-group-item">
                            <div class="categories-list">
                                <div class="content">
                                    <h2>{{$movie->title}}
                                        <small>[{{$movie->getComments()->count()}}]</small>
                                    </h2>
                                </div>
                                <ul class="list-group">
                                    @forelse($movie->getComments as $comment)
                                    <li class="list-group-item">
                                        <p>{{$comment->post}}</p>
                                        <div class="buttons">
                                            @if(Auth::user()->role >= 10)
                                            <form action="{{route('c_delete', $comment)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                            @endif
                                        </div>
                                    </li>
                                    @empty
                                    <li class="list-group-item">No comments</li>
                                    @endforelse
                                </ul>


                                <div class="buttons">
                                    @if(Auth::user()->role >= 10)
                                    <form action="{{route('c_delete', $category)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    @endif
                                </div>



                            </div>
                        </li>
                        @empty
                        <li class="list-group-item">No categories found</li>
                        @endforelse
                    </ul>
                </div>
                <div class="me-3 mx-3">
                    {{-- {{ $categories->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection