<?php

namespace App\Http\Controllers;

use App\ViewModels\PersonsViewModel;
use App\ViewModels\PersonViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PersonsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($page = 1)
    {
        abort_if($page > 500, 204);

        $popularPersons = Http::withToken(config('services.tmdb.token'))
                              ->get(config('services.tmdb.base_url') . '/person/popular?page=' . $page)
                              ->json()['results'];

        $viewModel = new PersonsViewModel($popularPersons, $page);

        return view('persons.index', $viewModel);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $person = Http::withToken(config('services.tmdb.token'))
                      ->get(config('services.tmdb.base_url') . '/person/' . $id)
                      ->json();

        $social = Http::withToken(config('services.tmdb.token'))
                      ->get(config('services.tmdb.base_url') . '/person/' . $id . '/external_ids')
                      ->json();

        $credits = Http::withToken(config('services.tmdb.token'))
                      ->get(config('services.tmdb.base_url') . '/person/' . $id . '/combined_credits')
                      ->json();

        $viewModel = new PersonViewModel($person, $social, $credits);

        return view('persons.show', $viewModel);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
