<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvViewModel extends ViewModel
{
    public $popularTv;
    public $topRatedTv;
    public $genres;

    public function __construct($popularTv, $topRatedTv, $genres)
    {
        $this->popularTv = $popularTv;
        $this->topRatedTv = $topRatedTv;
        $this->genres = $genres;
    }

    public function popularTv()
    {
        return $this->formatTv($this->popularTv);
    }

    public function topRatedTv()
    {
        return $this->formatTv($this->topRatedTv);
    }

    public function genres()
    {
        return $genres = collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }

    private function formatTv($tv)
    {
        return collect($tv)->map(function($tv) {
            $genresFormatted = collect($tv['genre_ids'])->mapWithKeys(function ($value) {
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

            return collect($tv)->merge([
                'poster_path' => $tv['poster_path']
                    ? 'https://image.tmdb.org/t/p/w500' . $tv['poster_path']
                    : '/images/default_movie_500.png',
                'first_air_date' => Carbon::parse($tv['first_air_date'])->format('d M Y'),
                'vote_average' => $tv['vote_average'] * 10 . '%',
                'genres' => $genresFormatted
            ]);
        });
    }
}
