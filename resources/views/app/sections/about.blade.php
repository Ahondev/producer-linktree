<section id="about" class="container">

    <x-image class="halo halo-1" name="halo-hero.png" alt="Background Halo" />
{{--    <img class="halo halo-1" src="{{ Vite::asset('resources/images/halo-hero.png') }}" alt="Background Halo">--}}

    <x-image class="halo halo-2" name="halo-hero.png" alt="Background Halo" />
{{--    <img class="halo halo-2" src="{{ Vite::asset('resources/images/halo-hero.png') }}" alt="Background Halo">--}}

    <x-image class="halo halo-3" name="halo-hero.png" alt="Background Halo" />
{{--    <img class="halo halo-3" src="{{ Vite::asset('resources/images/halo-hero.png') }}" alt="Background Halo">--}}

    <div class="about__title flex justify-center align-center">
        <h1 class="title__text font-secondary">
            Discover how your project will <br >
            be taken good of
        </h1>
    </div>

    <div class="about__content flex justify-center">

        <div class="icon-box">

            <div class="logo-container">
                <x-image class="step-1" name="about-stats.png" alt="Stats Icon" />
{{--                <img class="step-1" src="{{ Vite::asset('resources/images/about-stats.png') }}" alt="Stats Icon">--}}
                <x-image class="step-2" name="about-dev.png" alt="Dev Icon" />
{{--                <img class="step-2" src="{{ Vite::asset('resources/images/about-dev.png') }}" alt="Dev Icon">--}}
                <x-image class="step-3" name="about-deploy.png" alt="Deploy Icon" />
{{--                <img class="step-3" src="{{ Vite::asset('resources/images/about-deploy.png') }}" alt="Deploy Icon">--}}
                <x-image class="step-4" name="about-monitor.png" alt="Monitor Icon" />
{{--                <img class="step-4" src="{{ Vite::asset('resources/images/about-monitor.png') }}" alt="Monitor Icon">--}}
                @if(app()->environment("local"))
                    <lottie-player class="step-5" autoplay mode="normal" src="{{ Vite::asset('resources/lottie/checkmark.json') }}" style="width: 100%"></lottie-player>
                @else
                    <lottie-player class="step-5" autoplay mode="normal" src="{{ asset('resources/lottie/checkmark.json') }}" style="width: 100%"></lottie-player>
                @endif
            </div>

            <div class="steps-container">

                <div class="step-content step-content-1">
                    <div class="content__left">
                        <div class="chip">
                            <div class="chip__icon">@icon("stats.svg")</div>
                            <div class="chip__text">Planning and Analysis</div>
                        </div>
                        <div class="text">
                            This phase involves analyzing the requirements, conducting studies, selecting appropriate technologies, and setting deadlines.
                        </div>
                    </div>
                    <div class="content__right">
                        <div class="step__number">#1</div>
                    </div>
                </div>

                <div class="step-content step-content-2">
                    <div class="content__left">
                        <div class="step__number">#2</div>
                    </div>
                    <div class="content__right">
                        <div class="chip">
                            <div class="chip__icon">@icon("dev.svg")</div>
                            <div class="chip__text">Development and Testing</div>
                        </div>
                        <div class="text">
                            This step includes actual development, coding, testing, debugging, and ensuring the product meets the required standards.
                        </div>
                    </div>
                </div>

                <div class="step-content step-content-3">
                    <div class="content__left">
                        <div class="chip">
                            <div class="chip__icon">@icon("deploy.svg")</div>
                            <div class="chip__text">Implementation and Deployment</div>
                        </div>
                        <div class="text">
                            This phase involves deploying the product, providing necessary documentation, facilitating user adaptation, and offering initial client support and training.
                        </div>
                    </div>
                    <div class="content__right">
                        <div class="step__number">#3</div>
                    </div>
                </div>

                <div class="step-content step-content-4">
                    <div class="content__left">
                        <div class="step__number">#4</div>
                    </div>
                    <div class="content__right">
                        <div class="chip">
                            <div class="chip__icon">@icon("monitor.svg")</div>
                            <div class="chip__text">Monitoring and Supervision</div>
                        </div>
                        <div class="text">
                            Continuously supervising teams , overseeing the project's progress, and making necessary adjustments to ensure success.                        </div>
                    </div>
                </div>

            </div>

        </div>

        <hr>

    </div>

    <div class="about__trigger trigger trigger-1"></div>

    <div class="about__spacer spacer-1"></div>

    <div class="about__trigger trigger trigger-2"></div>

    <div class="about__spacer spacer-2"></div>

    <div class="about__trigger trigger trigger-3"></div>

    <div class="about__spacer spacer-3"></div>

    <div class="about__trigger trigger trigger-4"></div>

</section>
