@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-9">
            <div class="card">
                <div class="card-header">
                    <h2>Movie</h2>
                </div>
                <div class="card-body">
                    <div class="movie-show">
                    <div class="line"><small>Title:</small><h5>{{$movie->title}}</h5></div>
                    <div class="line"><small>Price:</small><h5>{{$movie->price}} {{$movie->make_year}}</h5></div>
                    <div class="line"><small>Category:</small><h5>{{$movie->getCategory->title}}</h5></div>
                    @if($movie->photo)
                    <div class="img">
                        <img src="{{$movie->photo}}" alt="photo">
                    </div>
                    @endif
                    <p>{{$movie->mechanic_notices}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection