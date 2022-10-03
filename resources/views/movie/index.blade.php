@extends('layouts.app')
@section('content')
<div class="container --content">
    <div class="row justify-content-center">
        <div class="col-9">
            <div class="card">
                <div class="card-header">
                    <h2>Movies</h2>
                    <form action="{{route('m_index')}}" method="get">
                        <div class="container">
                            <div class="row">
                                <div class="col-5">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-6">
                                                {{-- <select name="mech" class="form-select mt-1">
                                                    <option value="0">All</option>
                                                    @foreach($mechanics as $mechanic)
                                                    <option value="{{$mechanic->id}}" @if($mech==$mechanic->id) selected @endif>{{$mechanic->name}} {{$mechanic->surname}}</option>
                                                    @endforeach
                                                </select> --}}
                                            </div>
                                            <div class="col-6">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="input-group mb-3">
                                                    {{-- <input type="text" name="search" class="form-control" value="{{$search}}"> --}}
                                                <button type="submit" class="input-group-text">Search</button>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <a href="{{route('m_index')}}" class="btn btn-secondary">Reset</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($movies as $movie)
                        <li class="list-group-item">
                            <div class="movies-list">
                                <div class="content">
                                    <h2><span>Title: </span>{{$movie->title}}</h2>
                                    <h4><span>Price: </span>{{$movie->price}}</h4>
                                    <h5>
                                        <span>Category: </span>
                                        <a href="{{route('c_show', $movie->getCategory->id)}}">
                                            {{$movie->getCategory->title}}
                                        </a></h5>
                                    @if($movie->photo)
                                    <h5><a href="{{$movie->photo}}" target="_BLANK">Photo</a></h5>
                                    @endif
                                </div>
                                <div class="buttons">
                                    <a href="{{route('c_show', $movie)}}" class="btn btn-info">Show</a>
                                    <a href="{{route('c_edit', $movie)}}" class="btn btn-success">Edit</a>
                                    <form action="{{route('c_delete', $movie)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="list-group-item">No movies found</li>
                        @endforelse
                    </ul>
                </div>
            </div>
            <div class="me-3 mx-3">
                {{-- {{ $trucks->links() }} --}}
            </div>
        </div>
    </div>
</div>
@endsection