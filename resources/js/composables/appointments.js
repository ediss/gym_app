import {ref} from "vue";
import {useRouter} from "vue-router";
export default function useAppointments() {
    const appointments = ref([])
    const router = useRouter()
    const validationErrors = ref({})
    const getAppointments = async () => {
        axios.post('api/appointments')
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
        appointments, getAppointments, makeAppointment, validationErrors
    }
}
