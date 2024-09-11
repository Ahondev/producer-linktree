<div class="testimonial flex" index="{{ $index }}" style="--index: {{ $index }};">

    <div class="testimonial__image">
        <x-image name="testimonial-default.png" alt="{{ $testimonial->name }} review image" />
{{--        <img src="{{ Vite::asset('resources/images/testimonial-default.png') }}" alt="{{ $testimonial->name }} review image">--}}
    </div>

    <div class="testimonial__content">

        <div class="content__text">
            <div class="text__quote-start">@icon("quote.svg")</div>
            <div class="text__quote-end">@icon("quote.svg")</div>
            <p class="text__content">
                {{ $testimonial->content }}
            </p>
        </div>

        <div class="content__author">
            <div class="author__name"><strong>{{ $testimonial->name }}</strong></div>
            <div class="author__tag">{{ $testimonial->tag }}</div>
        </div>

    </div>

</div>
