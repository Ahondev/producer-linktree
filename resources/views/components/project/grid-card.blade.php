<a
        href="{{ $project->link }}"
        index="{{ $index }}"
        class="project"
        target="_blank"
        data-tilt data-tilt-glare data-tilt-max-glare="0.1" data-tilt-max="5" data-tilt-speed="400" data-tilt-perspective="800" data-tilt-reverse="true"
>

    <div class="project__image">
        <img src="{{ $project->image_url }}" alt="{{ $project->name }} project image">
    </div>

    <div class="project__content">
        <div class="project__title font-secondary flex justify-between align-center">
            <h4>{{ $project->name }}</h4>
            <div class="project__icon">
                @icon("arrow-link.svg")
            </div>
        </div>
        <div class="project__description font-secondary">
            {{ $project->description }}
        </div>
    </div>

</a>
