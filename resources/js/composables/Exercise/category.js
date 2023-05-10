import {ref} from "vue";
import {useRouter} from "vue-router";
export default function useCategory() {
    const router = useRouter();
    const categoryExercises = ref([])
    const exerciseCategories = ref([])


    const getExerciseCategories = async () => {

        axios.get('api/exercise-categories')
            .then(response => exerciseCategories.value = response.data.data)
            .catch(error => console.log(error))
    }
    const getCategoryExercises = async (categoryID, search_exercises = '') => {

        axios.get('/api/category-exercises/' + categoryID + '?search_exercises='+search_exercises)
            .then(response => {
                categoryExercises.value = response.data.data
            })
            .catch(error => console.log(error))
    }


    return {
        exerciseCategories,
        getExerciseCategories,
        categoryExercises,
        getCategoryExercises
    }
}
