@extends('web.layouts.app')

@section('content')
    <div class="row">

        <div class="col-10 m-auto">

            <h2 class="text-warning text-center mb-5">{{ $exercise->name }}</h2>

            <form @submit.prevent="createWorkout(workout)">

                {{--                <!--                {{appointment}}-->--}}

                <!--                <hr>-->

                @if (str_contains($exerciseTypeName, 'Weight'))
                    <div>
                        Weight
                        <hr>
                        <div class="input-group mb-3">
                    <span @click="decrement($event, 2.5)"
                          class="input-group-text text-danger font-24 font-weight-bold material-symbols-outlined">remove</span>
                            <input v-model="workout.weight"
                                   type="text" class="form-control text-center font-24 font-weight-bold">
                            <span @click="increment($event, 2.5)"
                                  class="material-symbols-outlined input-group-text text-success font-24">add</span>
                        </div>
                        <hr>
                    </div>
                @endif

                @if(str_contains($exerciseTypeName, 'Reps'))
                    <div>
                        Reps
                        <hr>
                        <div class="input-group mb-3">
                    <span @click="decrement($event, 1)"
                          class="input-group-text text-danger font-24 font-weight-bold material-symbols-outlined">remove</span>
                            <input v-model="workout.reps"
                                   type="text" class="form-control text-center font-24 font-weight-bold">
                            <span @click="increment($event, 1)"
                                  class="material-symbols-outlined input-group-text text-success font-24">add</span>
                        </div>
                        <hr>
                    </div>
                @endif

                @if(str_contains($exerciseTypeName, 'Time'))
                    <div>
                        Time
                    </div>
                @endif

                @if(str_contains($exerciseTypeName, 'Distance'))
                    <div>
                        Distance

                        <hr>
                        <div class="input-group mb-3">
                    <span @click="decrement($event, 1)"
                          class="input-group-text text-danger font-24 font-weight-bold material-symbols-outlined">remove</span>
                            <input v-model="workout.distance"
                                   type="text" class="form-control text-center font-24 font-weight-bold">
                            <span @click="increment($event, 1)"
                                  class="material-symbols-outlined input-group-text text-success font-24">add</span>
                        </div>
                        <hr>
                    </div>

                @endif




                <div class="d-flex d-grid align-items-center justify-content-center gap-3 mt-5">
                    <button class="btn btn-warning px-4 w-100">Save</button>
                    <!--                    <button type="button" class="btn btn-light px-4">Reset</button>-->
                </div>
            </form>
        </div>


        <!--    <p>upisi u workout podatke on save, i ostani tu dje jesi</p>-->
    </div>

@endsection

{{--ajax call insert data, and retrieve--}}
