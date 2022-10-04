@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h2>Edit Movie</h2>
                </div>
                <div class="card-body">
                    <form action="{{route('m_update', $movie)}}" method="post" enctype="multipart/form-data">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Title</span>
                        <input value="{{old('title', $movie->title)}}" type="text" name="title" class="form-control">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Price</span>
                        <input value="{{old('price', $movie->price)}}" type="text" name="price" class="form-control">
                    </div>
                    <div class="img--small mt-3">
                         @forelse($movie->getPhotos as $photo)
                    <div class="img">
                        <input class="form-check-input" type="checkbox" value="1" id="{{$photo->id}}-del-photo" name="delete_photo[]">
                        <label class="form-check-label" for="{{$photo->id}}-del-photo">
                            Delete photo
                        </label>
                        <img src="{{$photo->url}}" alt="photo">
                    </div>
                    @empty
                        <h3>No photos</h3>
                    @endforelse
                    </div>
                   
                    {{-- @if($movie->photo)
                        <div class="img-small mt-3">
                            <img src="{{$movie->photo}}">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="del-photo" name="delete_photo">
                                <label class="form-check-label" for="del-photo">
                                    Delete photo
                                </label>
                            </div>
                        </div>
                        @endif
                        <div class="input-group mt-3">
                            <span class="input-group-text">Photo</span>
                            <input type="file" name="photo" class="form-control">
                        </div> --}}
                    <select name="category_id" class="form-select mt-3">
                        <option value="0">Choose Category</option>
                        @foreach ($categories as $value)
                        <option value="{{$value->id}}" @if ($value->id == old($value->id, $movie->category_id)) selected @endif>{{$value->title}}</option>
                        @endforeach

                      </select>
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-secondary mt-4">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection