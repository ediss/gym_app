<template>
    <div class="col mt-3" v-for="appointment in appointments">
        <div class="card radius-10 border-0 border-start border-warning border-4">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="">
                        <p class="mb-1">{{appointment.appointment_start}}</p>
                        <h4 class="mb-0 text-warning">{{appointment.client_name}}</h4>
                    </div>

<!--                    <div class="ms-auto">-->
<!--                        <router-link :to="{name: 'workout.start',-->
<!--                                params: {-->
<!--                                     appointment_id: appointment.id,-->
<!--                                }-->
<!--                            }"-->
<!--                                     class="btn btn-outline-warning px-4 radius-30 border-0">-->
<!--                            <span class="material-symbols-outlined  font-30">play_circle</span> {{appointment.status}}-->
<!--                        </router-link>-->

<!--                    </div>-->
                </div>

            </div>
        </div>
    </div>
</template>


<script>
import {onMounted, reactive} from "vue";
import useAppointments from "../../composables/appointments";

export default {
    setup() {
        const appointment = reactive({
            status : ['finished', 'canceled']
        })

        const {appointments, getAppointments} = useAppointments()
        onMounted(getAppointments(appointment))

        return {appointments}
    },

}
</script>
