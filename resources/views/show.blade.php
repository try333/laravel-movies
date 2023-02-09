@extends('layouts.main')

@section('content')
<div class="movie-info border-b border-gray-800">
    <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
        <img src="{{ 'https://image.tmdb.org/t/p/w500/'.$movie['poster_path'] }}" alt="parasite" class="w-64 lg:w-96">
        <div class="md:ml-24">
            <h2 class="text-4xl font-semibold">{{ $movie['title'] }}</h2>
            <div class="flex flex-wrap items-center text-gray-400">
                <svg class="fill-current text-orange-500 w-4" viewBox="0 0 24 24">
                    <g data-name="Layer 2">
                        <path
                            d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 1 0 01-.62.18z"
                            data-name="star" />
                    </g>
                </svg>
                <span class="ml-1">{{ $movie['vote_average'] * 10 .'%' }}</span>
                <span class="mx-2">|</span>
                <span>{{ \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y') }}</span>
                <span class="mx-2">|</span>
                <span>
                    @foreach ($movie['genres'] as $genre)
                    {{ $genre['name'] }}@if (!$loop->last), @endif
                    @endforeach
                </span>
            </div>

            <p class="text-gray-300 mt-8">
                {{ $movie['overview'] }}
            </p>
            <div class="mt-12">
                <h4 class="text-white font-semibold">Featured Cast</h4>
                <div class="flex mt-4">

                    @foreach ($movie['credits']['crew'] as $crew)
                    @if ($loop->index < 2) <div class="mr-8">
                        <div>{{$crew['name'] }}</div>
                        <div class="text-sm text-gray-400">{{ $crew['job'] }}</div>
                </div>
                @endif

                @endforeach

            </div>

            @if (count($movie['videos']['results']) > 0)
            <div class="mt-12">
                <button data-modal-target="defaultModal" data-modal-toggle="defaultModal"
                    class="inline-flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150"
                    type="button">
                    <img src="{{ asset('img/play-button.png') }}" alt="play trailer btn" class="w-6">
                    <span class="ml-2">Play Trailer</span>
                </button>
            </div>
            @endif

            <!--Youtube Trailer Modal-->
            <div id="defaultModal" tabindex="-1" aria-hidden="true"
                class="fixed top-0 left-0 right-0 z-50 hidden w-full md:p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                    <div class="bg-gray-900 rounded">
                        <div class="flex justify-end pr-4 pt-2">
                            <button class="text-3xl leading-none hover:text-gray-300 closemodal"
                                data-modal-hide="defaultModal" onclick="stopyt()">&times;
                            </button>
                        </div>
                        <div class="modal-body md:px-8 md:py-8">
                            <div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%">
                                <iframe id="iframeyt" class="responsive-iframe absolute top-0 left-0 w-full h-full"
                                    src="https://www.youtube.com/embed/{{ $movie['videos']['results'][0]['key'] }}"
                                    style="border:0;" allow="autoplay; encrypted-media" allowfullscreen></iframe>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
<!--end movie-info-->

<div class="movie-cast border-b border-gray-800">
    <div class="container mx-auto px-4 py-16">
        <h2 class="text-4xl font-semibold">Cast</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">

            @foreach ($movie['credits']['cast'] as $cast)
            @if ($loop->index < 10) <div class="mt-8">
                <a href="#">
                    <img src="{{ 'https://image.tmdb.org/t/p/w300/'.$cast['profile_path'] }}" alt="{{ $cast['name'] }}"
                        class="hover:opacity-75 transition ease-in-out duration-150">
                </a>
                <div class="mt-2">
                    <a href="#" class="text-lg mt-2 hover:text-gray-300">{{ $cast['name'] }}</a>
                    <div class="flex items-center text-gray-400 text-sm">
                        {{ $cast['character'] }}
                    </div>
                </div>
        </div>
        @endif
        @endforeach
    </div>
</div>

<div class="movie-images border-b border-gray-800">
    <div class="container mx-auto px-4 py-16">
        <h2 class="text-4xl font-semibold">Images</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach ($movie['images']['backdrops'] as $image)
            @if ($loop->index < 9) <div class="mt-8">
                <a href="#">
                    <img src="{{ 'https://image.tmdb.org/t/p/w500/'.$image['file_path'] }}"
                        class="hover:opacity-75 transition ease-in-out duration-150">
                </a>
        </div>
        @endif
        @endforeach

    </div>
</div>
</div>





</div>
@endsection
<script>
    function stopyt() {
        document.getElementById('iframeyt').src = document.getElementById('iframeyt').src;
    }
</script>