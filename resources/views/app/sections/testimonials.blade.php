<section id="testimonials" class="container">

    <x-image class="halo halo-1" name="halo-hero.png" alt="Background Halo" />
{{--    <img class="halo halo-1" src="{{ Vite::asset('resources/images/halo-hero.png') }}" alt="Background Halo">--}}

    <div class="testimonials__heading">

        <h1 class="heading__title font-secondary">
            What about customers?
        </h1>

        <div class="heading__sub flex justify-between">
            <div class="sub__text">
                This phase involves analyzing the requirements, conducting studies, selecting appropriate technologies, and setting deadlines.
            </div>
            <div class="sub__buttons flex">
                <div class="button__prev slider-control" action="prev">
                    @icon("slider-arrow.svg")
                </div>
                <div class="button__next slider-control" action="next">
                    @icon("slider-arrow.svg")
                </div>
            </div>
        </div>

    </div>

    <div class="testimonials__slider">
        <swiper-container init="false" slides-per-view="3" rewind="true" grab-cursor="true" space-between="350">
            @foreach($testimonials as $testimonial)
                <swiper-slide >
                    @php $index = $loop->index; @endphp
                    <div class="slide__content">
                        <x-testimonial.testimonial :testimonial="$testimonial" :index="$index" />
                    </div>
                </swiper-slide>
            @endforeach
        </swiper-container>
    </div>

</section>
