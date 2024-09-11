@foreach($columns as $column)

    @php $columnPosition = $loop->index === 0 ? 'left' : 'right' @endphp

    <div class="col col-{{ $columnPosition }}">

        @php $index = 0; @endphp
        @foreach($column as $project)

            <x-project.grid-card :project="$project" :index="$index" />

        @php $index = $index === 2 ? 0 : $index + 1; @endphp
        @endforeach

    </div>

@endforeach
