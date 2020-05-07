<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvShowViewModel extends ViewModel
{
    public $tv;

    public function __construct($tv)
    {
        $this->tv = $tv;
    }

    public function tv()
    {
        return collect($this->tv)->merge([
            'poster_path' => $this->tv['poster_path']
                ? 'https://image.tmdb.org/t/p/w500' . $this->tv['poster_path']
                : '/images/default_movie_500.png',
            'first_air_date' => Carbon::parse($this->tv['first_air_date'])->format('d M Y'),
            'vote_average' => $this->tv['vote_average'] * 10 . '%',
            'genres' => collect($this->tv['genres'])->pluck('name')->flatten()->implode(', '),
            'crew' => collect($this->tv['credits']['crew'])->take(2),
            'cast' => collect($this->tv['credits']['cast'])->take(5)->map(function ($cast) {
                return collect($cast)->merge([
                    'profile_path' => $cast['profile_path']
                        ? 'https://image.tmdb.org/t/p/w500' . $cast['profile_path']
                        : '/images/default_people_profile.png'
                ]);
            }),
            'images' => collect($this->tv['images']['backdrops'])->take(9),
        ]);
    }
}
