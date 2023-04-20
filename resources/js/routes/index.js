import {createRouter, createWebHistory} from "vue-router";

import AppointmentIndex from "../components/Appointments/Index.vue";
import AppointmentCreate from "../components/Appointments/Create.vue";
import WelcomeIndex from "../Welcome.vue";
import WorkoutCreate from "../components/Workout/Create.vue"

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
        path: '/create-workout',
        name: 'workout.create',
        component: WorkoutCreate,
        props: true
    }
]

export default  createRouter({
    history: createWebHistory(),
    routes
})



