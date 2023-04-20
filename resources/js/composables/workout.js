import {ref} from "vue";

export default function useWorkout() {
    const workout = ref([])
    // const createWorkout = async () => {
    //     axios.post('api/createWorkout')
    //         .then(response => appointments.value = response.data.data)
    //         .catch(error => console.log(error))
    // }
    return {
        workout, createWorkout
    }
}
