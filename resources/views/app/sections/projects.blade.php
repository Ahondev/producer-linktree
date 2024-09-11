<section id="projects" class="container">

    <x-image class="halo halo-1" name="halo-hero.png" alt="Background Halo" />
{{--    <img class="halo halo-1" src="{{ Vite::asset('resources/images/halo-hero.png') }}" alt="Background Halo">--}}

    <div class="projects__title flex justify-between align-center">
        <h1 class="title__text font-secondary">
            Featured projects
        </h1>
        <a href="https://github.com/Ahondev" target=_blank" class="btn btn-primary">
            View all projects
        </a>
    </div>

    <div class="projects__content">
        <x-project.grid-view :projects="$projects" />
    </div>

{{--    <div class="projects__button flex justify-center">--}}
{{--        <a href="javascript:void(0)" class="link">See more</a>--}}
{{--    </div>--}}

</section>
