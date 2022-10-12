<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tag.index', [
            'tags' => Tag::orderBy('updated_at', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Tag::create([
            'title' => $request->title,
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $Tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        return view('tag.show', [
            'tag' => $tag
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $Tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('tag.edit', [
            'tag' => $tag
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Tag  $Tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $tag->update(
            ['title' => $request->title]
        );
        return redirect()->route('c_index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $Tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        if ($tag->hasMovies()->count()) {
            return 'Negalima';
        }
        $tag->delete();
        return redirect()->route('c_index');
    }
    public function destroyAll(Tag $tag)
    {
        $movies = $tag->hasMovies();

        $ids = $movies->pluck('id')->all();
        Movie::destroy($ids);
        return redirect()->route('c_index');
    }
}