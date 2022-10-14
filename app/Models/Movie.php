<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\MovieTag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'price'];

    const SORT_SELECT = [
        ["rate_asc", "Rating 1 - 9"],
        ["rate_desc", "Rating 9 - 1"],
        ["title_asc", "Title A - Z"],
        ["title_desc", "Title Z - A"],
        ["price_asc", "Price lowest"],
        ["price_desc", "Price highest"]
    ];

    public function getPhotos()
    {
        return $this->hasMany(MovieImage::class, 'movie_id', 'id');
    }
    public function getPivot()
    {
        return $this->hasMany(MovieTag::class, 'movie_id', 'id');
    }

    public function getTags()
    {
        return $this->belongsToMany(Tag::class, 'movie_tags', 'movie_id', 'tag_id');
    }

    public function lastImageUrl()
    {
        return $this->getPhotos()->orderBy('id', 'desc')->first()->url;
    }
    public function addImages(?array $photos): self
    {
        if ($photos) {
            $movieImage = [];
            $time = Carbon::now();
            foreach ($photos as $photo) {
                $ext = $photo->getClientOriginalExtension();
                $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                $file = $name . '-' . rand(100000, 999999) . '.' . $ext;
                $photo->move(public_path() . '/images', $file);

                $movieImage[] = [
                    'url' => asset('/images') . '/' . $file,
                    'movie_id' => $this->id,
                    'created_at' => $time,
                    'updated_at' => $time,
                ];
            }
            MovieImage::insert($movieImage);
        }
        return $this;
    }
    public function removeImages(?array $photos): self
    {
        if ($photos) {

            $toDelete = MovieImage::whereIn('id', $photos)->get();

            foreach ($toDelete as $photo) {

                $file = public_path() . '/images/' . pathinfo($photo->url, PATHINFO_FILENAME) . '.' . pathinfo($photo->url, PATHINFO_EXTENSION);
                if (file_exists($file)) {
                    unlink($file);
                }
            }
            MovieImage::destroy($photos);
        }
        return $this;
    }
    public function getComments()
    {
        return $this->hasMany(Comment::class, 'movie_id', 'id');
    }
    public function addTags(?array $tags): self
    {
        if ($tags) {
            $tagsNow = $this->getPivot()->pluck('tag_id')->all();
            $tags = array_map(fn ($id) => (int)$id, $tags);
            $insertTags = array_diff($tags, $tagsNow);

            $movieTag = [];
            $time = Carbon::now();
            foreach ($insertTags as $tag) {
                $movieTag[] = [
                    'movie_id' => $this->id,
                    'tag_id' => $tag,
                    'created_at' => $time,
                    'updated_at' => $time,
                ];
            }
            MovieTag::insert($movieTag);
        }
        return $this;
    }
    public function removeTags(?array $tags): self
    {
        $tagsNow = $this->getPivot()->pluck('tag_id')->all();
        $tags = array_map(fn ($id) => (int)$id, $tags);
        $deleteTags = array_diff($tagsNow, $tags);
        MovieTag::whereIn('tag_id', $deleteTags)->delete();
        return $this;
    }
}
