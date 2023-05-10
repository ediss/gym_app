<template>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-xl-4 row-cols-xxl-4">

        <div class="d-flex align-items-center mb-4">
            <div class="">
<!--                <label class="form-label">Date Format</label>-->
<!--                <input type="hidden" class="form-control date-format flatpickr-input" value="2023-04-21"><input class="form-control date-format input" placeholder="" tabindex="0" type="text" readonly="readonly">-->

                <h1>Appointments</h1>
            </div>


            <div class="text-warning ms-auto">
                <router-link :to="{name: 'appointment.create'}"
                             class=" btn btn-outline-warning px-0 radius-30 border-0">
                    <span class="font-30 material-symbols-outlined font-40">add</span>
                </router-link>
            </div>
        </div>

        <div class="col-12">

                <ul class="nav nav-tabs nav-warning d-flex justify-content-between" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-bs-toggle="tab" href="#appointments-all" role="tab" aria-selected="true">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon">
                                    <i class="fadeIn animated bx bx-list-ul font-20 me-1"></i>
                                </div>
                                <div class="tab-title">All</div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#appointments-started" role="tab" aria-selected="false">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon">
                                    <i class="fadeIn animated bx bx-play-circle font-20 me-1"></i>
                                </div>
                                <div class="tab-title">
                                    Started
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#appointments-finished" role="tab" aria-selected="false">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon">
                                    <i class="fadeIn animated bx bx-check-circle font-20 me-1"></i>

                                </div>
                                <div class="tab-title">Finished</div>
                            </div>
                        </a>
                    </li>
                </ul>
                <div class="tab-content py-3">
                    <div class="tab-pane fade show active" id="appointments-all" role="tabpanel">
                        <div class="col mt-3" v-for="appointment in appointments">
                            <div class="card radius-10 border-0 border-start border-warning border-4">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="">
                                            <p class="mb-1">{{appointment.appointment_start}}</p>
                                            <h4 class="mb-0 text-warning">{{appointment.client_name}}</h4>
                                        </div>


                                        <div class="ms-auto">
                                            <router-link :to="{
                                                name: 'appointment.start',
                                                params: {
                                                     appointment_id: appointment.id,
                                                }
                                            }"
                                            class="btn btn-outline-warning px-4 radius-30 border-0">
                                            <span class="material-symbols-outlined  font-30">play_circle</span>start
                                            </router-link>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="tab-pane fade" id="appointments-started" role="tabpanel">
                        <Started></Started>
                    </div>
                    <div class="tab-pane fade" id="appointments-finished" role="tabpanel">
                        <Finished></Finished>
                    </div>
                </div>
        </div>

<!--        <div class="col" v-for="appointment in appointments">-->
<!--            <div class="card radius-10 border-0 border-start border-warning border-4">-->
<!--                <div class="card-body">-->
<!--                    <div class="d-flex align-items-center">-->
<!--                        <div class="">-->
<!--                            <p class="mb-1">{{appointment.appointment_start}}</p>-->
<!--                            <h4 class="mb-0 text-warning">{{appointment.client_name}}</h4>-->
<!--                        </div>-->

<!--                        <div class="ms-auto">-->
<!--                            <router-link :to="{name: 'workout.create',-->
<!--                                params: {-->
<!--                                     clientId: appointment.client_id,-->
<!--                                     clientName: appointment.client_name-->
<!--                                }-->
<!--                            }"-->
<!--                                class="btn btn-outline-warning px-4 radius-30 border-0">-->
<!--                                <span class="material-symbols-outlined  font-30">play_circle</span>start-->
<!--                            </router-link>-->

<!--                        </div>-->
<!--                    </div>-->

<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
    </div>
</template>

<script>
import {onMounted} from "vue";
import useAppointments from "../../composables/appointments";

import Started from "../Appointments/Started.vue";
import Finished from "./Finished.vue";

export default {
    components: {Finished, Started},
    setup() {
        const {appointments, getAppointments} = useAppointments()
        onMounted(getAppointments)

        return {appointments}
    },

}

//kada klikne na start promeni appointment tekst start u nesto kao in progress
// prvo otvaras kategorije vezbi, ili search sve vezbe, tek onda otvaras vezbu i serije...

// kada klikce unazad pratice ga istorija dakle kategorija vezbi ili search a ako ode jos nazad onda na appointments
//koji je sada promenio stanje u in progress, kada je in progress onda otvaras getWorkout i imas podatke u client id-u i imas podatke o pocetku odnosno danu treninga








// methods:{
// ...mapActions({
//         signOut:"auth/logout"
//     }),
//         async logout(){
//         await axios.post('/logout').then(({data})=>{
//             this.signOut()
//             this.$router.push({name:"login"})
//         })
//     }
// }

//prilikom logina dohvati sve klijente i imaj to kroz celu app sa sobom example:

// import { useAuth0 } from "@auth0/auth0-vue";
//
// const { loginWithRedirect } = useAuth0();

// create client

// CRUD exercises



// create new appointment cancel appointment, edit appointment


</script>


<style>
.font-40 {

    font-size : 40px !important;
}
</style>
