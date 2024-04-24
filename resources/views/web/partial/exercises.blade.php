@php
    if($usageType === 'start_appointment') {
        $route = 'workout.create';
    }else {
        $route = 'exercise.edit';
    }
@endphp

@foreach($exercises as $exercise)

    
    <form method="GET" action="{{ route($route, ['appointment' => $appointmentID, 'exercise' => $exercise]) }}">
        
        
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
