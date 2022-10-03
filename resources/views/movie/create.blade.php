@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h2>New Movie</h2>
                </div>
                <div class="card-body">
                    <form action="{{route('m_store')}}" method="post" enctype="multipart/form-data">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Title</span>
                            <input value="{{old('title')}}" name="title" type="text" class="form-control">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Price</span>
                            <input value="{{old('price')}}" name="price" type="text" class="form-control">
                        </div>
                        <select name="mechanic_id" class="form-select mt-3">
                            <option value="0">Choose category</option>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}" @if($category->id == old('category_id')) selected @endif>{{$category->title}}</option>
                            @endforeach

                        </select>
                        <div data-clone class="input-group mt-3">
                            <span class="input-group-text">Upload Img</span>
                            <input type="file" name="photo[]" multiple class="form-control">
                        </div>
                        @csrf
                        <button type="submit" class="btn btn-secondary mt-4">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
