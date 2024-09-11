@if($vite == "dev")
{{--    <img {{ $class ? 'class="'. $class .'"' : '' }} src="{{ Vite::asset('resources/images/' . $name) }}" alt="{{ $alt }}" />--}}
    <img @if($class) class="{{ $class }}" @endif src="{{ Vite::asset('resources/images/' . $name) }}" alt="{{ $alt }}" />
@else
{{--    <img {{ $class ? 'class="'. $class .'"' : '' }} src="{{ asset('build/resources/images/' . $name) }}" alt="{{ $alt }}" />--}}
    <img @if($class) class="{{ $class }}" @endif src="{{ asset('build/resources/images/' . $name) }}" alt="{{ $alt }}" />
@endif
