@extends('layouts.main')

@section('content')
    <div class="tv-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
            <div class="flex-none">
                <img src="{{ $tv['poster_path'] }}"
                     alt="{{ $tv['name'] }}"
                     class="w-64 md:w-96"
                >
            </div>
            <div class="md:ml-24">
                <h2 class="text-4xl font-bold text-yellow-500">{{ $tv['name'] }}</h2>
                <div class="flex flex-wrap items-center text-gray-400 text-sm">
                    <svg class="fill-current w-4 text-yellow-500" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0z" fill="none"></path><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path><path d="M0 0h24v24H0z" fill="none"></path>
                    </svg>
                    <span class="ml-1">{{ $tv['vote_average'] }}</span>
                    <span class="mx-2"> | </span>
                    <span>{{ $tv['first_air_date'] }}</span>
                    <span class="mx-2"> | </span>
                    {{ $tv['genres'] }}
                </div>

                <p class="text-gray-300 mt-8">{{ $tv['overview'] }}</p>

                <div class="mt-12">
                    <h4 class="text-white font-semibold mt-8">Created By</h4>
                    <div class="flex mt-4">
                        @foreach($tv['created_by'] as $crew)
                            <div class="mr-8">
                                <div>{{ $crew['name'] }}</div>
                                <div class="text-sm text-gray-400">Creator</div>
                            </div>
                        @endforeach
                    </div>
                    @if(count($tv['crew']) > 0)
                        <h4 class="text-white font-semibold mt-8">Featured Crew</h4>
                        <div class="flex mt-4">
                            @foreach($tv['crew'] as $crew)
                                <div class="mr-8">
                                    <div>{{ $crew['name'] }}</div>
                                    <div class="text-sm text-gray-400">{{ $crew['job'] }}</div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div x-data="{ isOpen: false }">
                    @if(count($tv['videos']['results']) > 0)
                        <div class="mt-12">
                            <button @click="isOpen = true"
                                    target="_blank"
                                    class="flex inline-flex items-center bg-yellow-500 text-gray-900 rounded font-semibold px-5 py-3 hover:bg-yellow-600 transition ease-in-out duration-150"
                            >
                                <svg viewBox="0 0 24 24" class="fill-current w-6">
                                    <path d="M0 0h24v24H0z" fill="none"></path><path d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"></path>
                                </svg>
                                <span class="ml-2">Trailer</span>
                            </button>
                        </div>
                        <div style="background-color: rgba(0, 0, 0, .5);"
                             class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                             x-show.transition.opacity="isOpen"
                        >
                            <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                                <div class="bg-gray-900 rounded">
                                    <div class="flex justify-end pr-4 pt-2">
                                        <button @click="isOpen = false"
                                                @keydown.escape.window="isOpen= false"
                                                class="text-3xl leading-none hover:text-gray-300"
                                        >&times;
                                        </button>
                                    </div>
                                    <div class="modal-body px-8 py-8">
                                        <div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%">
                                            <iframe class="responsive-iframe absolute top-0 left-0 w-full h-full"
                                                    src="https://www.youtube.com/embed/{{ $tv['videos']['results'][0]['key'] }}"
                                                    style="border:0;"
                                                    allow="autoplay; encrypted-media"
                                                    allowfullscreen
                                            ></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="tv-cast border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-bold">Cast</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">

                @foreach($tv['cast'] as $cast)
                    <div class="mt-8">
                        <a href="{{ route('persons.show', $cast['id']) }}">
                            <img src="{{ $cast['profile_path'] }}"
                                 alt="{{ $cast['name'] }}"
                                 class="hover:opacity-75 transition ease-in-out duration-150"
                            >
                        </a>
                        <div class="mt-2">
                            <a href="{{ route('persons.show', $cast['id']) }}" class="text-lg mt-2 hover:text-gray-300">{{ $cast['name'] }}</a>
                            <div class="text-gray-400 text-sm">{{ $cast['character'] }}</div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    @if(count($tv['images']) > 0)
        <div class="tv-images" x-data="{ isOpen: false, image: '' }">
            <div class="container mx-auto px-4 py-16">
                <h2 class="text-4xl font-bold">Images</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                    @foreach($tv['images'] as $image)
                        <div class="mt-8">
                            <a @click.prevent="isOpen = true, image='{{ 'https://image.tmdb.org/t/p/original/' . $image['file_path'] }}'"
                               href="#">
                                <img src="{{ 'https://image.tmdb.org/t/p/w500' . $image['file_path'] }}"
                                     alt=""
                                     class="hover:opacity-75 transition ease-in-out duration-150"
                                >
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div style="background-color: rgba(0, 0, 0, .5);"
                 class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                 x-show.transition.opacity="isOpen"
            >
                <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                    <div class="bg-gray-900 rounded">
                        <div class="flex justify-end pr-4 pt-2">
                            <button @click="isOpen = false"
                                    @keydown.escape.window="isOpen= false"
                                    class="text-3xl leading-none hover:text-gray-300"
                            >&times;
                            </button>
                        </div>
                        <div class="modal-body px-8 py-8">
                            <img :src="image"
                                 alt=""
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
