<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Tests\TestCase;

class ViewMoviesTest extends TestCase
{
    /**
     * @test
     */
    public function the_main_page_shows_correct_info()
    {
        Http::fake([
            'https://api.themoviedb.org/3/movie/popular' => $this->fakePopularMovies(),
            'https://api.themoviedb.org/3/movie/now_playing' => $this->fakeNowPlayingMovies(),
            'https://api.themoviedb.org/3/genre/movie/list' => $this->fakeGenres(),
        ]);

        $response = $this->get(route('movies.index'));

        $response->assertSuccessful();
        $response->assertSee('Popular Movies');
        $response->assertSee('Fake Movie');
        $response->assertSee('Drama, Science Fiction');
        $response->assertSee('Now Playing');
        $response->assertSee('Now Playing Fake Movie');
    }

    /**
     * @test
     */
    public function the_movie_page_shows_the_correct_info()
    {
        Http::fake([
            'https://api.themoviedb.org/3/movie/*' => $this->fakeSingleMovie(),
        ]);

        $response = $this->get(route('movies.show', 12345));
        $response->assertSee('Fake Jumanji');
        $response->assertSee('Jeanne McCarthy');
        $response->assertSee('Casting Director');
        $response->assertSee('Dwayne Johnson');
    }

    /**
     * @test
     */
    public function the_search_dropdown_works_correctly()
    {
        Http::fake([
            'https://api.themoviedb.org/3/search/movie?query=jumanji' => $this->fakeSearchMovies(),
        ]);

        Livewire::test('search-dropdown')
                ->assertDontSee('jumanji')
                ->set('search', 'jumanji')
                ->assertSee('jumanji');
    }

    private function fakeSearchMovies()
    {
        return Http::response([
            'results' => [
                [
                    "popularity" => 501.422,
                    "vote_count" => 3164,
                    "video" => false,
                    "poster_path" => "/xBHvZcjRiWyobQ9kxBhO6B2dtRI.jpg",
                    "id" => 419704,
                    "adult" => false,
                    "backdrop_path" => "/5BwqwxMEjeFtdknRV792Svo0K1v.jpg",
                    "original_language" => "en",
                    "original_title" => "jumanji",
                    "genre_ids" => [
                        0 => 18,
                        1 => 878,
                    ],
                    "title" => "jumanji",
                    "vote_average" => 6,
                    "overview" => "The near most Fake Search Movie",
                    "release_date" => "2019-09-17",
                ],
            ],
        ], 200);
    }

    private function fakePopularMovies()
    {
        return Http::response([
            'results' => [
                [
                    "popularity" => 501.422,
                    "vote_count" => 3164,
                    "video" => false,
                    "poster_path" => "/xBHvZcjRiWyobQ9kxBhO6B2dtRI.jpg",
                    "id" => 419704,
                    "adult" => false,
                    "backdrop_path" => "/5BwqwxMEjeFtdknRV792Svo0K1v.jpg",
                    "original_language" => "en",
                    "original_title" => "Fake Movie",
                    "genre_ids" => [
                        0 => 18,
                        1 => 878,
                    ],
                    "title" => "Fake Movie",
                    "vote_average" => 6,
                    "overview" => "The near most Fake Movie",
                    "release_date" => "2019-09-17",
                ],
            ],
        ], 200);
    }

    private function fakeNowPlayingMovies()
    {
        return Http::response([
            'results' => [
                [
                    "popularity" => 501.422,
                    "vote_count" => 3164,
                    "video" => false,
                    "poster_path" => "/xBHvZcjRiWyobQ9kxBhO6B2dtRI.jpg",
                    "id" => 419704,
                    "adult" => false,
                    "backdrop_path" => "/5BwqwxMEjeFtdknRV792Svo0K1v.jpg",
                    "original_language" => "en",
                    "original_title" => "The Now Playing Fake Movie",
                    "genre_ids" => [
                        0 => 18,
                        1 => 878,
                    ],
                    "title" => "The Now Playing Fake Movie",
                    "vote_average" => 6,
                    "overview" => "This is a The Now Fake Playing Movie",
                    "release_date" => "2019-09-17",
                ],
            ],
        ], 200);
    }

    private function fakeSingleMovie()
    {
        return [
            "adult" => false,
            "backdrop_path" => "/zTxHf9iIOCqRbxvl8W5QYKrsMLq.jpg",
            "budget" => 125000000,
            "genres" => [
                "id" => 12,
                "name" => "Adventure",
            ],
            [
                "id" => 35,
                "name" => "Comedy",
            ],
            [
                "id" => 14,
                "name" => "Fantasy",
            ],
            "homepage" => "http://jumanjimovie.com",
            "id" => 512200,
            "imdb_id" => "tt7975244",
            "original_language" => "en",
            "original_title" => "Jumanji: The Next Level",
            "overview" => "As the gang return to Jumanji to rescue one of their own, they discover that nothing is as they expect. The players will have to brave parts unknown and unexplo",
            "popularity" => 114.323,
            "poster_path" => "/bB42KDdfWkOvmzmYkmK58ZlCa9P.jpg",
            "release_date" => "2019-12-04",
            "revenue" => 310830000,
            "runtime" => 123,
            "status" => "Released",
            "tagline" => "",
            "title" => "Jumanji: The Next Level",
            "video" => false,
            "vote_average" => 6.9,
            "credits" => [
                "cast" => [
                    "cast_id" => 2,
                    "character" => "Dr. Smolder Bravestone",
                    "credit_id" => "5aac3960c3a36846ea005147",
                    "gender" => 2,
                    "id" => 18918,
                    "name" => "Dwayne Johnson",
                    "order" => 0,
                    "profile_path" => "/gNDWZkr6tST1Z5xcOCUwthY78CN.jpg",
                ],
                "crew" => [
                    "credit_id" => "5d51d4ff18b75100174608d8",
                    "department" => "Production",
                    "gender" => 1,
                    "id" => 546,
                    "job" => "Casting Director",
                    "name" => "Jeanne McCarthy",
                    "profile_path" => null,
                ],
            ],
        ];
    }

    private function fakeGenres()
    {
    }
}
