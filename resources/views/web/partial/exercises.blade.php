@php
    if($usageType === 'start_appointment') {
        $route = 'workout.create';

        $additional_param = false;
    }else {
        $route = 'exercise.edit';

        $additional_param = true;
    }
@endphp

@foreach($exercises as $exercise)

    {{-- <form method="GET" action="{{ route($route, $additional_param ?? ['exercise' => $exercise->id]) }}"> --}}
    <form method="GET" action="{{ route($route, ['exercise' => $exercise]) }}">
        @csrf
        <input type="hidden" value="{{$appointmentID}}" name="appointmentID">
        <input type="hidden" value="{{$exercise->id}}" name="exercise_id">
        <div class="card radius-10 border-0 border-start border-warning border-4 submitForm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="">
                        <p class="mb-1 text-white">
                            {{ $exercise->category->name }}
                        </p>
                        <h4 class="mb-0 text-warning text-capitalize">
                            {{ $exercise->name }}
                        </h4>
                    </div>
                </div>

            </div>
        </div>
    </form>

@endforeach
