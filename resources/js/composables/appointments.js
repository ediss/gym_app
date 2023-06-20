import {ref} from "vue";
import {useRouter} from "vue-router";
export default function useAppointments() {
    const appointment = ref([])
    const appointments = ref([])
    const router = useRouter()
    const validationErrors = ref({})

    const getAppointment = async (appointmentProp = null) => {

        axios.post('api/get-appointment', appointmentProp)
            .then(response => appointment.value = response.data.data)
            .catch(error => console.log(error))
    }
    const getAppointments = async (appointment = null) => {
        axios.post('api/appointments', appointment)
            .then(response => appointments.value = response.data.data)
            .catch(error => console.log(error))
    }
    const makeAppointment = async (appointment) => {
        axios.post('api/make-appointment', appointment)
            .then(response => {
                router.push({name: 'appointments'})
            })
            .catch(error => {
                if(error.response?.data) {
                    validationErrors.value = error.response.data.errors;

                    console.log(validationErrors);
                }
            })

    }
    return {
        appointment, getAppointment, appointments, getAppointments, makeAppointment, validationErrors
    }
}
