<template>

    <div class="row">

        <div class="col-10 m-auto">

            <h2 class="text-warning text-center mb-5">{{ exercise.name }}</h2>

            <form @submit.prevent="createWorkout(workout)">

<!--                {{appointment}}-->

<!--                <hr>-->


            <div v-if="exercise?.type?.includes('Weight')">
                Weight
                <hr>
                <div class="input-group mb-3">
                    <span @click="decrement($event, 2.5)"
                        class="input-group-text text-danger font-24 font-weight-bold material-symbols-outlined">remove</span>
                        <input v-model="workout.weight"
                               type="text" class="form-control text-center font-24 font-weight-bold" >
                    <span @click="increment($event, 2.5)"
                        class="material-symbols-outlined input-group-text text-success font-24">add</span>
                </div>
                <hr>
            </div>
            <div v-if="exercise?.type?.includes('Reps')">
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
            <div v-if="exercise?.type?.includes('Time')">
                Time
            </div>
            <div v-if="exercise?.type?.includes('Distance')">
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


                <div class="d-flex d-grid align-items-center justify-content-center gap-3 mt-5">
                    <button class="btn btn-warning px-4 w-100">Save</button>
<!--                    <button type="button" class="btn btn-light px-4">Reset</button>-->
                </div>
            </form>
        </div>


<!--    <p>preko appointment id dohvati coach id i client id,</p>-->


<!--    <p>upisi u workout podatke on save, i ostani tu dje jesi</p>-->
    </div>
</template>
<style>

.form-control:focus {
    box-shadow: none;
    border: 1px solid #495057;;
}
</style>
<script>

import {computed, onBeforeMount, onMounted, reactive, ref, toRefs} from "vue";
import useExercises from "../../composables/Exercise/exercise";
import useWorkout from "../../composables/workout";
import useAppointments from "../../composables/appointments";


export default {
    props: {
        appointment_id: {
            type: String,
            required: true
        },

        exercise_id: {
            required: true
        },
    },

    setup(props) {


        const appointmentProp = reactive({
            appointment_id : props.appointment_id,
        })

        const {
            exercise,
            getExercise,
        } = useExercises();

        const {
            appointment,
            getAppointment,
        } = useAppointments();


        const {
            createWorkout
        } = useWorkout();

        onMounted(() => {
            getAppointment(appointmentProp)
            getExercise(props.exercise_id);
        });



        //
        //console.log(this.appointment.client_id);



        const workout = reactive({
            exercise_id: Number(props.exercise_id),
            appointment_id: Number(appointmentProp.appointment_id),
            appointment: appointment,
            client_id: '',
            coach_id: '',
            weight: null,
            reps: null,
            distance: null
        })


        function increment(event, value) {
            let closest_input = event.target.parentElement.querySelector('input');
            closest_input.value = Number(closest_input.value) + value;

            closest_input.focus();

        }

        function decrement(event, value) {

            let closest_input = event.target.parentElement.querySelector('input');
            if(closest_input.value > 0) {
                closest_input.value = Number(closest_input.value) - value;
            }
        }


        return { appointment, exercise, workout, createWorkout, increment, decrement }

    }
}
</script>
