@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 py-16">
        <div class="popular-persons">
            <h2 class="uppercase tracking-wider text-yellow-600 text-lg font-semibold">Popular People</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach($popularPersons as $person)
                    <div class="person mt-8">
                        <a href="{{ route('persons.show', $person['id']) }}">
                            <img src="{{ $person['profile_path'] }}"
                                 alt="{{ $person['name'] }}"
                                 class="hover:opacity-75 transition ease-in-out duration-75"
                            >
                        </a>
                        <div class="mt-2">
                            <a href="{{ route('persons.show', $person['id']) }}" class="text-lg mt-2 hover:text-gray-300">{{ $person['name'] }}</a>
                            <div class="text-sm truncate text-gray-400">{{ $person['known_for'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="page-load-status my-8">
            <div class="flex justify-center">
                <p class="infinite-scroll-request spinner my-8 text-4xl">&nbsp;</p>
            </div>
            <p class="infinite-scroll-last">End of content</p>
            <p class="infinite-scroll-error">Error</p>
        </div>
        {{--<div class="flex justify-between mt-16">
            @if($previous)
                <a href="/persons/page/{{ $previous }}">Previous</a>
            @else
                <div></div>
            @endif
            @if($next)
                <a href="/persons/page/{{ $next }}">Next</a>
            @else
                <div></div>
            @endif
        </div>--}}
    </div>
@endsection
@section('scripts')
    <script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js"></script>
    <script>
        var elem = document.querySelector('.grid');
        var infScroll = new InfiniteScroll( elem, {
            // options
            path: '/persons/page/@{{#}}',
            append: '.person',
            status: '.page-load-status',
            //history: false,
        });

    </script>
@endsection
