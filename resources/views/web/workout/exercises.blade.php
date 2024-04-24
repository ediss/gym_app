@php
    $counter = 1;
@endphp

@foreach ($workouts as $workout)

    <div class="col-12 {{ !$loop->last ? 'border-bottom' : '' }}">
        <div class="row m-auto text-warning font-20 py-3 text-center">
            <span class="d-none workout-id">{{ $workout->id }}</span>

            <div class="col-2 px-0 workout-comment">
                <span class="material-symbols-outlined">comment</span>
            </div>
            <div class="col-2 px-0"><b>{{ $counter++ }} </b></div>

            @if (str_contains($workout->exercise->type->name, 'Weight'))
                <div class="col-4 px-2 text-end workout-update">

                    <span class="d-none exercises-type-value-input-name">weight</span>

                    <span class="exercises-type-value">
                        {{ $workout->weight }}
                    </span>
                    <span class="text-warning-emphasis font-12"> kgs</span>
                </div>
            @endif


            @if (str_contains($workout->exercise->type->name, 'Reps'))
                <div class="col-4 text-end workout-update">
                    <span class="d-none exercises-type-value-input-name">reps</span>

                    <span class="exercises-type-value">
                        {{ $workout->reps }}
                    </span>
                    <span class="text-warning-emphasis font-12"> reps</span>
                </div>
            @endif


            @if (str_contains($workout->exercise->type->name, 'Time'))
                <div class="col-4 text-end workout-update">
                    <span class="exercises-type-value">
                        {{ $workout->time }}
                    </span>
                    <span class="text-warning-emphasis font-12"> hours min seconds</span>
                </div>
            @endif

            @if (str_contains($workout->exercise->type->name, 'Distance'))
                <div class="col-4 text-end workout-update">
                    <span class="exercises-type-value">
                        {{ $workout->distance }}
                    </span>
                    <span class="text-warning-emphasis font-12"> m</span>
                </div>
            @endif

        </div>
    </div>


@endforeach
