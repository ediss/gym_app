@extends('web.layouts.app')
@section('custom-css')
    <style>
        .accordion-button:not(.collapsed) {
            color: black;
            /*background-color: transparent;*/
            background-color:  rgba(var(--bs-warning-rgb), var(--bs-text-opacity))!important;;
            box-shadow: none;

        }

        .accordion-button:focus {
            box-shadow: none;

        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-12 mb-4">
            <label class="w-100">
                <input name="search_exercises" id="searchExercises" type="text" class="form-control" value=''
                       placeholder="Search..."
                       oninput="searchExercises()" data-usage-type="start_appointment"
                       data-appointment={{$appointmentID}}>
            </label>
        </div>


        <div class="col-12" id="exerciseCategories">
            <div class="card">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach($categories as $category)
                            <li class="d-flex justify-content-between align-items-center list-group-item category"
                                data-category-id="{{$category->id}}"
                                data-usage-type="start_appointment"
                                data-appointment-id={{$appointmentID}}
                            >
                                {{ $category->name }}
                                <span class="badge border border-warning rounded-pill font-15 ">
                                    {{ $category->exercises_count }}
                                </span>

                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div id="exerciseResults" class="col-12"></div>

        <div id="workout" class="col-12">

            <div class="card">
                @if(isset($workouts))

                <div class="card-body">
                    <h5 class="card-title">Workouts</h5>
                    <div class="my-3 border-top"></div>
                    <div class="accordion accordion-flush" id="accordionFlushExample">

                        @php
                            $counter = 1;
                        @endphp
                        @foreach($workouts as $key => $workout)
                            @php
                                $counter++;
                            @endphp

                            <div class="accordion-item">
                                <h1 class="accordion-header text-light" id="flush-heading{{ $counter }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $counter }}" aria-expanded="false" aria-controls="flush-collapse{{ $counter }}">
                                        {{$key}}
                                    </button>
                                </h1>

                                <div id="flush-collapse{{ $counter }}" class="accordion-collapse collapse" aria-labelledby="flush-heading-{{ $counter }}" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body px-0">
                                        @include('web.workout.exercises', ['workouts' => $workout])

                                    </div>
                                </div>
                            </div>


                        @endforeach

                    </div>
                </div>

            @endif
            </div>
        </div>


        <div class="col-12">
                @if(isset($workouts))
                    @foreach($workouts as $key => $workout)

                        <h3 class="mt-5  text-light">{{$key}}</h3>

                    <div class="card">
                        @include('web.workout.exercises', ['workouts' => $workout])
                    </div>

                    @endforeach
                @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('exercises/exercises.js')}}"></script>
@endsection
