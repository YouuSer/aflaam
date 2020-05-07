<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class PersonViewModel extends ViewModel
{
    public $person;
    public $social;
    public $credits;

    public function __construct($person, $social, $credits)
    {
        $this->person = $person;
        $this->social = $social;
        $this->credits = $credits;
    }

    public function person()
    {
        return collect($this->person)->merge([
            'birthday' => Carbon::parse($this->person['birthday'])->format('d M Y'),
            'age' => Carbon::parse($this->person['birthday'])->age,
            'profile_path' => $this->person['profile_path']
                ? 'https://image.tmdb.org/t/p/w300' . $this->person['profile_path']
                : '/images/default_people_profile.png',
        ]);
    }

    public function social()
    {
        return collect($this->social)->merge([
            'twitter' => $this->social['twitter_id']
                ? 'https://twitter.com/' . $this->social['twitter_id']
                : null,
            'facebook' => $this->social['facebook_id']
                ? 'https://facebook.com/' . $this->social['facebook_id']
                : null,
            'instagram' => $this->social['instagram_id']
                ? 'https://instagram.com/' . $this->social['instagram_id']
                : null,
            'imdb' => $this->social['imdb_id']
                ? 'https://www.imdb.com/name/' . $this->social['imdb_id']
                : null,
        ]);
    }

    public function knownForMovies()
    {
        $castMovies = collect($this->credits)->get('cast');

        return collect($castMovies)
            ->sortByDesc('popularity')
            ->take(5)
            ->map(function ($movie) {
                if (isset($movie['title'])) {
                    $title = $movie['title'];
                } elseif ($movie['name']) {
                    $title = $movie['name'];
                } else {
                    $title = 'Untitled';
                }
                return collect($movie)->merge([
                    'poster_path' => $movie['poster_path']
                        ? 'https://image.tmdb.org/t/p/w185' . $movie['poster_path']
                        : '/images/default_movie_500.png',
                    'title' => $title,
                    'linkToPage' => $movie['media_type'] === 'movie'
                        ? route('movies.show', $movie['id'])
                        : route('tv.show', $movie['id']),
                ]);
            });
    }

    public function credits()
    {
        $creditsMovies = collect($this->credits)->get('cast');

        return collect($creditsMovies)->map(function ($movie) {
           if (isset($movie['release_date'])) {
               $releaseDate = $movie['release_date'];
           } elseif (isset($movie['first_air_date'])) {
               $releaseDate = $movie['first_air_date'];
           } else {
               $releaseDate = '';
           }

           if (isset($movie['title'])) {
               $title = $movie['title'];
           } elseif ($movie['name']) {
               $title = $movie['name'];
           } else {
               $title = 'Untitled';
           }

            return collect($movie)->merge([
                'release_date' => $releaseDate,
                'release_year'  => isset($releaseDate) ? Carbon::parse($releaseDate)->format('Y') : 'Future',
                'title' => $title,
                'character' => $movie['character'] !== '' ? 'as ' . $movie['character'] : '',
                'linkToPage' => $movie['media_type'] === 'movie'
                    ? route('movies.show', $movie['id'])
                    : route('tv.show', $movie['id']),
            ]);
        })->sortByDesc('release_date');
    }
}
