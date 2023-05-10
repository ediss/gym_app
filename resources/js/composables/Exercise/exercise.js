import {ref} from "vue";
import {useRouter} from "vue-router";
export default function useExercises() {
    const exercises = ref([])
    const exerciseTypes = ref([])
    const router = useRouter()
    const validationErrors = ref({})
    const getExercises = async (search_exercises = '') => {
        axios.get('api/exercises/?search_exercises='+ search_exercises)
            .then(response => exercises.value = response.data.data)
            .catch(error => console.log(error))
    }
    const getExerciseTypes = async () => {
        axios.get('api/exercise-types')
            .then(response => exerciseTypes.value = response.data.data)
            .catch(error => console.log(error))
    }
    const createExercise = async (exercise) => {
        axios.post('api/create-exercise', exercise)
            .then(response => {
                router.push({name: 'exercises.index'})
            })
            .catch(error => {
                if(error.response?.data) {
                    validationErrors.value = error.response.data.errors;

                    console.log(validationErrors);
                }
            })
    }


    return {
        exercises,
        exerciseTypes,
        getExerciseTypes,
        getExercises,
        createExercise,
        validationErrors,
    }
}
