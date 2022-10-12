@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-5">
            <div class="card">
                <div class="card-header">
                    <h2>New Movie</h2>
                </div>
                <div class="card-body">
                    <form action="{{route('m_update', $movie)}}" method="post" enctype="multipart/form-data">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Title</span>
                            <input type="text" name="title" class="form-control" value="{{old('title', $movie->title)}}">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Price</span>
                            <input type="text" name="price" class="form-control" value="{{old('price', $movie->price)}}">
                        </div>
                        <div class="input-group mt-3">
                            <span class="input-group-text">Photo</span>
                            <input type="file" name="photo[]" multiple class="form-control">
                        </div>
                        @forelse($tags as $tag)
                            <div class="form-check">
                                <input @if(in_array($tag->id, $checkedTags)) checked @endif class="form-check-input" name="tag[]" type="checkbox" value="{{$tag->id}}" id="_{{$tag->id}}">
                                <label class="form-check-label" for="_{{$tag->id}}">
                                    {{$tag->title}}
                                </label>
                            </div>
                        @empty
                            <h3>No tags available</h3>
                        @endforelse
                        <div class="img-small-ch mt-3">
                            @forelse($movie->getPhotos as $photo)
                            <div class="img">
                                <label for="{{$photo->id}}-del-photo">X</label>
                                <input type="checkbox" value="{{$photo->id}}" id="{{$photo->id}}-del-photo" name="delete_photo[]">
                                <img src="{{$photo->url}}">
                            </div>
                            @empty
                            <h2>No photos yet.</h2>
                            @endforelse
                        </div>
                        @csrf
                        @method('put')
                        <button type="submit" class="btn btn-secondary mt-4">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection