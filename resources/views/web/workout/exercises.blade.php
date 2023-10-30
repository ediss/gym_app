@php
    $counter = 1;
@endphp

@foreach($workouts as $workout)

    <div class="col-10 m-auto {{!$loop->last ? 'border-bottom': ''}}">
        <div class="row m-auto text-warning font-20 py-3 text-center">
        <span class="d-none workout-id">{{$workout->id}}</span>

        <div class="col-2 px-0 workout-comment"><span class="material-symbols-outlined">comment</span></div>
        <div class="col-2 px-0"><b>{{ $counter ++ }} </b></div>

        <div class="col-4 px-2 text-end workout-update">
            @if (str_contains($workout->exercise->type->name, 'Weight'))
                <span class="d-none exercises-type-value-input-name">weight</span>

                <span class="exercises-type-value">
                    {{ $workout->weight }}
                </span>
                    <span class="text-warning-emphasis font-12"> kgs</span>
            @endif
        </div>

        <div class="col-4 text-end workout-update">
            @if (str_contains($workout->exercise->type->name, 'Reps'))
                <span class="d-none exercises-type-value-input-name">reps</span>

                <span class="exercises-type-value">
                    {{ $workout->reps }}
                </span>
                    <span class="text-warning-emphasis font-12"> reps</span>

            @endif
        </div>
        <div class="col-4 text-end workout-update">
            @if (str_contains($workout->exercise->type->name, 'Time'))

                <span class="exercises-type-value">
                    {{ $workout->time }}
                </span>
                    <span class="text-warning-emphasis font-12"> hours min seconds</span>

            @endif
        </div>
        <div class="col-4 text-end workout-update">
            @if (str_contains($workout->exercise->type->name, 'Distance'))

                <span class="exercises-type-value">
                    {{ $workout->distance }}
                </span>
                    <span class="text-warning-emphasis font-12"> meters/kms</span>

            @endif
        </div>


    </div>
    </div>
@endforeach
