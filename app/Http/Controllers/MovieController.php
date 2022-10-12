<?php
namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Tag;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('movie.index', [
        'movies' => Movie::orderBy('updated_at', 'desc')->paginate(5),
       ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('movie.create', [
            'tags' => Tag::orderBy('title')->get()
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request;  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:3|max:10',
            'price' => 'required|numeric|min:1|max:100',
            'photo.*' => 'sometimes|required|mimes:jpg|max:3000'
        ],
        [
            'title.required' => 'No title',
            'price.required' => 'No price',
            'price.required' => 'No price'
        ]);
        Movie::create([
            'title' => $request->title,
            'price' => $request->price
        ])->addImages($request->file('photo'))
        ->addTags($request->tag);

        return redirect()->route('m_index')->with('ok', 'Success');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        return view('movie.show', [
            'movie' => $movie,
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        return view('movie.edit', [
            'movie' => $movie,
            'tags' => Tag::orderBy('title')->get(),
            'checkedTags' => $movie->getPivot->pluck('tag_id')->all(),
            ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request;  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'title' => 'required|min:3|max:10',
            'price' => 'required|numeric|min:1|max:100',
            'photo.*' => 'sometimes|required|mimes:jpg|max:3000'
        ],
        [
            'title.required' => 'No title',
            'price.required' => 'No price',
            'price.required' => 'No price'
        ]);
        $movie
        ->update([
            'title' => $request->title,
            'price' => $request->price
        ]);
        $movie
        ->removeImages($request->delete_photo)
        ->addImages($request->file('photo'));

        return redirect()->route('m_index')->with('ok', 'Success');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        if ($movie->getPhotos()->count()) {
            $delIds = $movie->getPhotos()->pluck('id')->all();
            $movie->removeImages($delIds);
        }
        $title = $movie->title;
        $movie->delete();
        return redirect()->route('m_index')->with('ok', '"' . $title . '"' . ' has been deleted');
    }
}