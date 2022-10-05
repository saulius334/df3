<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function homeList()
    {
       return view('home.index', [
        'movies' => Movie::orderBy('title', 'desc')->get(),
       ]);
    }
    public function rate(Request $request, Movie $movie) {
        $movie->rating_sum = $movie->rating_sum + $request->rate;
        $movie->rating_num++;
        $movie->rating = $movie->rating_sum / $movie->rating_num;
        $movie->save();
        return redirect()->back();
    }
}
