<div class="relative mt-3 md:mt-0" x-data="{ isOpen: true }" @click.away="isOpen = false">
    <input wire:model.debounce.500ms="search"
           type="text"
           placeholder="Search"
           class="bg-gray-800 text-sm rounded-full w-64 px-4 pl-8 py-1 focus:outline-none focus:shadow-outline"
           x-ref="search"
           @keydown.window="
                if (event.keyCode === 191) {
                    event.preventDefault();
                    $refs.search.focus();
                }
            "
           @focus="isOpen = true"
           @keydown="isOpen = true"
           @keydown.escape.window="isOpen = false"
           @keydown.shift.tab="isOpen = false"
    >
    <div class="absolute top-0">
        <svg class="fill-current w-4 mt-2 ml-2 text-gray-500" viewBox="0 0 20 20">
            <path d="M19.129,18.164l-4.518-4.52c1.152-1.373,1.852-3.143,1.852-5.077c0-4.361-3.535-7.896-7.896-7.896
								c-4.361,0-7.896,3.535-7.896,7.896s3.535,7.896,7.896,7.896c1.934,0,3.705-0.698,5.078-1.853l4.52,4.519
								c0.266,0.268,0.699,0.268,0.965,0C19.396,18.863,19.396,18.431,19.129,18.164z M8.567,15.028c-3.568,0-6.461-2.893-6.461-6.461
								s2.893-6.461,6.461-6.461c3.568,0,6.46,2.893,6.46,6.461S12.135,15.028,8.567,15.028z"></path>
        </svg>
    </div>
    <div wire:loading class="spinner top-0 right-0 mr-4 mt-3"></div>
    @if(strlen($search) > 2)
        <div class="z-50 absolute bg-gray-800 text-sm rounded w-64 mt-4"
             x-show.transition.opacity="isOpen"
        >
            @if($searchResults->count() > 0)
                <ul>
                    @foreach($searchResults as $result)
                        <li class="border-b border-gray-700">
                            <a href="{{ route('movies.show', $result['id']) }}"
                               class="block hover:bg-gray-700 px-3 py-3 flex items-center"
                                {{-- lorsque l'on utilise tab sur le dropdown search celui ci se cache après avoir "tabé" le dernier résultat --}}
                               @if ($loop->last) @keydown.tab="isOpen = false" @endif
                            >
                            @if($result['poster_path'])
                                    <img src="{{ 'https://image.tmdb.org/t/p/w92' . $result['poster_path'] }}"
                                         alt="{{ $result['title'] }}" class="w-8"
                                    >
                                @else
                                    <img src="/images/default_movie_50.png"
                                         alt="{{ $result['title'] }}" class="w-8"
                                    >
                                @endif
                                <span class="ml-2">{{ $result['title'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="px-3 py-3">No results for "{{ $search }}"</div>
            @endif
        </div>
    @endif
</div>
