@if($workouts->count() > 0)
    <div class="card bg-transparent">

        <div class="card-body">

            <div class="accordion accordion-flush" id="accordionFlushExample">

                @php
                    $counter = 1;
                @endphp
                @foreach($workouts as $key => $workout)
                    @php
                        $counter++;
                    @endphp

                    <div class="accordion-item bg-transparent">
                        <h1 class="accordion-header text-light" id="flush-heading{{ $counter }}">
                            <button class="accordion-button collapsed bg-transparent" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapse{{ $counter }}" aria-expanded="false"
                                    aria-controls="flush-collapse{{ $counter }}">
                                {{$key}}
                            </button>
                        </h1>

                        <a>
                        <div id="flush-collapse{{ $counter }}" class="accordion-collapse collapse add-more-reps"
                             aria-labelledby="flush-heading{{ $counter }}" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body px-0">
                                @include('web.workout.exercises', ['workouts' => $workout])
                            </div>
                        </div>
                        </a>
                    </div>

                @endforeach

            </div>
        </div>

    </div>
@endif
