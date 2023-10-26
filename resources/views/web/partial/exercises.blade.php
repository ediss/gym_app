@php
    if($usageType === 'start_appointment') {
        $route = 'workout.create';
        $params = [
            'appointment' => $appointment
        ];
    }else {
        $route = 'exercise.crud';
        $params = [];
    }
@endphp
@foreach($exercises as $exercise)

    @php
        $params['exercise_id'] = $exercise->id;
    @endphp
    <a href="{{ route($route, $params)  }}">
        <div class="card radius-10 border-0 border-start border-warning border-4">
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
    </a>

@endforeach


{{--<router-link v-for="exercise in exercises"--}}
{{--             v-show="search_exercises !== ''"--}}
{{--             :to="{--}}
{{--                         name: 'workout.create',--}}
{{--                         params: {--}}
{{--                             appointment_id:appointment_id,--}}
{{--                             exercise_id:exercise.id--}}
{{--                         }--}}
{{--                     }"--}}
{{--             class="col-12">--}}
{{--</router-link>--}}
