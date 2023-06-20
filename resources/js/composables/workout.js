import {ref} from "vue";

export default function useWorkout() {

    const createWorkout = async (workout) => {


        console.log(workout.coach_id)

         workout.coach_id = workout.appointment.coach_id;
         workout.client_id = workout.appointment.client_id;




        delete workout.appointment;

        //console.log(workout)

        axios.post('api/create-workout', workout)
            .then(response => {

            })
            .catch(error => console.log(error))
    }
    return {
         createWorkout
    }
}
