<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        return view('tag.index', [
            'tags' => Tag::orderBy('updated_at', 'desc')->get()
        ]);
    }

    public function create()
    {
        return view('tag.create');
    }

    public function store(Request $request)
    {
        Tag::create([
            'title' => $request->title,
        ]);
        return redirect()->route('t_index');
    }

    public function show(Tag $tag)
    {
        return view('tag.show', [
            'tag' => $tag
        ]);
    }

    public function edit(Tag $tag)
    {
        return view('tag.edit', [
            'tag' => $tag
        ]);
    }
    public function update(Request $request, Tag $tag)
    {
        $tag->update([
            'title' => $request->title
            ]);
        return redirect()->route('c_index');
    }
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('c_index');
    }
}