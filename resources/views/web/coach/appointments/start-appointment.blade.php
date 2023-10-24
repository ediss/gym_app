@extends('web.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12 mb-4">
            <input v-model="search_exercises" type="text" class="form-control" placeholder="Search...">
        </div>

        <div class="col-12" id="categories-card"
             v-show="!isLoading && search_exercises.length === 0">
            <div class="card" >
                <div class="card-body">
                    <ul class="list-group list-group-flush">

                        @foreach($categories as $category)
                            <li @click="getCategoryExercisesClick(category.id)"
                                class="d-flex justify-content-between align-items-center list-group-item">
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

        <router-link v-for="exercise in exercises"
                     v-show="search_exercises !== ''"
                     :to="{
                         name: 'workout.create',
                         params: {
                             appointment_id:appointment_id,
                             exercise_id:exercise.id
                         }
                     }"
                     class="col-12">
            <div class="card radius-10 border-0 border-start border-warning border-4">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <p class="mb-1 text-white">
{{--                                {{ exercise.category }}--}}
                            </p>
                            <h4 class="mb-0 text-warning text-capitalize">
{{--                                {{ exercise.name  }}--}}
                            </h4>
                        </div>
                    </div>

                </div>
            </div>
        </router-link>

        <router-link v-for="exercise in categoryExercises"
                     v-show="isLoading && search_exercises.length === 0"
                     :to="{
                         name: 'workout.create',
                         params: {
                             appointment_id:appointment_id,
                             exercise_id:exercise.id
                         }
                     }"
                     class="col-12">
            <div class="card radius-10 border-0 border-start border-warning border-4" @click="test()">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <p class="mb-1 text-white">
{{--                                {{ exercise.category }}--}}
                            </p>
                            <h4 class="mb-0 text-warning text-capitalize">
{{--                                {{ exercise.name  }}--}}
                            </h4>
                        </div>
                    </div>

                </div>
            </div>
        </router-link>

    </div>
@endsection
