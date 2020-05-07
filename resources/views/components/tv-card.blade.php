<div class="mt-8">
    <a href="{{ route('tv.show', $tv['id']) }}">
        <img src="{{ $tv['poster_path'] }}"
             alt="{{ $tv['name'] }}"
             class="hover:opacity-75 transition ease-in-out duration-75"
        >
    </a>
    <div class="mt-2">
        <a href="" class="text-lg mt-2 hover:text-gray-300">{{ $tv['name'] }}</a>
        <div class="flex items-center text-gray-400 text-sm mt-1">
            <svg class="fill-current w-4 text-yellow-500" viewBox="0 0 24 24">
                <path d="M0 0h24v24H0z" fill="none"></path><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path><path d="M0 0h24v24H0z" fill="none"></path>
            </svg>
            <span class="ml-1">{{ $tv['vote_average'] }}</span>
            <span class="mx-2"> | </span>
            <span>{{ $tv['first_air_date'] }}</span>
        </div>
        <div class="text-gray-400 text-sm">{{ $tv['genres'] }}</div>
    </div>
</div>
