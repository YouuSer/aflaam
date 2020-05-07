<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class PersonsViewModel extends ViewModel
{
    public $popularPersons;
    public $page;

    public function __construct($popularPersons, $page)
    {
        $this->popularPersons = $popularPersons;
        $this->page = $page;
    }

    public function popularPersons()
    {
        return collect($this->popularPersons)->map(function ($person) {

            return collect($person)->merge([
                'profile_path' => $person['profile_path']
                    ? 'https://image.tmdb.org/t/p/w235_and_h235_face' . $person['profile_path']
                    : 'https://eu.ui-avatars.com/api/?size=235&name=' . $person['name'],
                'known_for' => collect($person['known_for'])
                    ->where('media_type', 'movie')
                    ->pluck('title')
                    ->union(collect($person['known_for'])
                        ->where('media_type', 'tv')
                        ->pluck('name'))
                    ->implode(', '),
            ]);
        });
    }

    public function previous()
    {
        return $this->page > 1 ? $this->page - 1 : null;
    }

    public function next()
    {
        return $this->page < 500 ? $this->page + 1 : null;
    }
}
