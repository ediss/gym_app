<template>
    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4 text-warning text-center">Make Appointment</h5>
                    <form @submit.prevent = "makeAppointment(appointment)"
                        class="row g-3">



                        <div class="col-md-12">
                            <div class="input-group mb-3">

                                <span class="input-group-text text-warning bg-transparent" >
                                    <i class="lni lni-calendar"></i>
                                </span>

                                <input v-model="appointment.start_date" type="text"  placeholder="Select Date.."

                                       class="form-control flatpickr">
                            </div>

                            <div class="text-danger">
                                <div v-for="message in validationErrors?.start_date">
                                    {{ message }}
                                </div>
                            </div>

                        </div>


                        <div class="col-12">

                            <select v-model = "appointment.client_id" id="appointment-client" class="form-select">

                                <option v-for="client in clients" :value="client.id">
                                    {{ client.name }}
                                </option>
                            </select>

                            <div class="text-danger">
                                <div v-for="message in validationErrors?.client_id">
                                    {{ message }}
                                </div>
                            </div>
                        </div>



                        <div class="col-md-12 mt-5 px-3">
                                <button class="btn btn-warning px-5 w-100">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import {onMounted, reactive} from "vue";
import useClients from "../../composables/client";
import useAppointments from "../../composables/appointments";
import 'flatpickr/dist/themes/dark.css'
import flatpickr from "flatpickr";
export default {
    setup() {
        const appointment = reactive({
            start_date : new Date().format('d M Y 00:00') ,
            client_id : '',
            status: 'started'
        })

        const { clients, getClients } = useClients()
        const { makeAppointment, validationErrors } = useAppointments()

        onMounted(() => {
            flatpickr(".flatpickr", {
                enableTime: true,
                time_24hr: true,
                disableMobile: true,
                // defaultDate: new Date(),
                dateFormat: "d M Y H:i",
            });

            getClients();
        })

        return {clients, appointment, makeAppointment, validationErrors}
    },

}

//kada klikne na start promeni appointment tekst start u nesto kao in progress
// prvo otvaras kategorije vezbi, ili search sve vezbe, tek onda otvaras vezbu i serije...

// kada klikce unazad pratice ga istorija dakle kategorija vezbi ili search a ako ode jos nazad onda na appointments
//koji je sada promeni stanje u in progress, kada je in progress onda otvaras getWorkout i imas podatke u client id-u i imas podatke o pocetku odnosno danu treninga








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
