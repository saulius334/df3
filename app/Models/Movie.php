<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'price', 'category_id'];

    public function getCategory()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function getPhotos() {
        return $this->hasMany(MovieImage::class, 'movie_id', 'id');
    }
    public function lastImageUrl() {
        return $this->getPhotos()->orderBy('id', 'desc')->first()->url;
    }
    public function addImages(?array $photos) : void {
        if ($photos) {
        $movieImage = [];
        $time = Carbon::now();
        foreach($photos as $photo) {
            $ext = $photo->getClientOriginalExtension();
            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            $file = $name. '-' . rand(100000, 999999). '.' . $ext;
            $photo->move(public_path().'/images', $file);

            $movieImage[] = [
                'url' => asset('/images') . '/' . $file, 
                'movie_id' => $this->id,
                'created_at' => $time,
                'updated_at' => $time,
            ];
        }
        MovieImage::insert($movieImage);
    }
}
}
