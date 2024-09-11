@extends("layout.app")
@section('title', $campaign->name)

@section('content')

    <div
        class="content {{ 'background-' . $appearance->background_type }} {{ 'theme-' . $appearance->theme }}"
        style="--background: {{ $appearance->value }}"
    >

        <h1 class="title">{{ $page->title }}</h1>

        <div class="card">
            <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class="rickroll">
                <img src="{{ $page->image->source }}"  alt="{{ $page->title }} Image"/>
            </a>
        </div>

        <p>{{ $page->text }}</p>

        <div class="links">

            @foreach($links as $link)
                <a href="{{ $link->url }}" class="button apple" target="_blank">
                    @include('app.campaign.icons.' . $link->platform)
                </a>
            @endforeach

        </div>
    </div>

@endsection
