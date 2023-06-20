import {createRouter, createWebHistory} from "vue-router";

import AppointmentIndex from "../components/Appointments/Index.vue";
import AppointmentCreate from "../components/Appointments/Create.vue";
import WorkoutCreate from "../components/Workout/Create.vue"
import AppointmentStart from "../components/Appointments/Start.vue"
import ClientCreate from "../components/Client/Create.vue"
import ClientsIndex from "../components/Client/Index.vue"
import ExerciseCreate from "../components/Exercise/Create.vue"
import ExercisesIndex from "../components/Exercise/Index.vue"

import CategoryExercises from "../components/Category/Exercises.vue"

const routes = [
    {
        path: '/',
        name: 'appointments',
        component: AppointmentIndex,

    },

    {
        path: '/create-appointment',
        name: 'appointment.create',
        component: AppointmentCreate,

    },

    {
        path: '/start-appointment/:appointment_id',
        name: 'appointment.start',
        component: AppointmentStart,
        props: true
    },

    {
        path: '/create-workout/:appointment_id/:exercise_id',
        name: 'workout.create',
        component: WorkoutCreate,
        props: true
    },

    {
        path: '/clients',
        name: 'clients.index',
        component: ClientsIndex,

    },

    {
        path: '/add-client',
        name: 'client.create',
        component: ClientCreate,
    },

    {
        path: '/exercises',
        name: 'exercises.index',
        component: ExercisesIndex,

    },

    {
        path: '/create-exercise',
        name: 'exercise.create',
        component: ExerciseCreate,
    },

    {
        path: '/category-exercises/:category_id',
        name: 'category.exercises',
        component: CategoryExercises,
    },





]

export default  createRouter({
    history: createWebHistory(),
    routes
})



