@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-5">
            <div class="card">
                <div class="card-header">
                    <h2>Change category</h2>
                </div>
                <div class="card-body">
                    <form action="{{route('c_edit', $category)}}" method="post">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Name</span>
                        <input type="text" value={{old('name', $category->title)}} name="title" class="form-control">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Surname</span>
                        <input type="text" value={{old('surname', $category->surname)}} name="surname" class="form-control">
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