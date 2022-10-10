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
                    @forelse($movie->getPhotos as $photo)
                    <div class="img">
                        <img src="{{$photo->url}}" alt="photo">
                    </div>
                    @empty
                        <h3>No photos</h3>
                    @endforelse

                    <p>{{$movie->mechanic_notices}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection