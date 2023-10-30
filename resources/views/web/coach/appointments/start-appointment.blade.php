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


        </div>

    </div>
@endsection

@section('scripts')
    <script>
        function fetchWorkouts(appointmentId) {
            fetch('{{route('appointment.workouts')}}', {
                method: 'POST',
                body: JSON.stringify({ appointmentId: appointmentId }),
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then(response => response.text())
                .then(html => {
                    // Update the DOM with the fetched Blade view
                    document.getElementById('workout').innerHTML = html;
                })
                .catch(error => console.error('Error fetching workout exercises: ' + error));
        }
        document.addEventListener("DOMContentLoaded", function () {



            fetchWorkouts({{$appointmentID}})
        });
    </script>
    <script src="{{asset('exercises/exercises.js')}}"></script>
@endsection
