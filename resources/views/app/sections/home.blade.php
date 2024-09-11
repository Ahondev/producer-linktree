<section id="home" class="container flex justify-between align-center">

    <div class="home__content">

        <div class="content__hey flex justify-start align-center">
            <div class="hey__emoji">
                <x-image name="hey-emoji.png" alt="Hey Emoji" />
            </div>
            <div class="hey__text font-secondary">Hey i’m Ahon</div>
        </div>

        <div class="content__title">
            <h1 class="title__text font-secondary">Let's craft nice products!</h1>
        </div>

        <div class="content__description">
            <p class="description__text font-secondary">I’m a Web Developper and UI/UX Designer who works with startups and entrepreneurs.</p>
        </div>

        <div class="content__button">
            <a href="/#get-in-touch" class="btn btn-primary">Build your dream project now</a>
        </div>

    </div>

    <div class="home__image">

        <div class="image-wrapper">
{{--            <img src="{{ Vite::asset('resources/images/hero.png') }}" alt="Hero">--}}
            <x-image name="hero.png" alt="Hero" />
{{--            <img class="image__halo" src="{{ Vite::asset('resources/images/halo-hero.png') }}" alt="Background Halo">--}}
            <x-image class="image__halo" name="halo-hero.png" alt="Background Halo" />
        </div>

    </div>

</section>
