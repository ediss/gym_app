<template>
    <div class="col-12 mb-4">
        <input v-model="search_exercises" type="text" class="form-control" placeholder="Search...">
    </div>

    <div class="col" v-for="exercise in categoryExercises">
        <div class="card radius-10 border-0 border-start border-warning border-4">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="">
                        <p class="mb-1 text-white">{{ exercise.category }}</p>
                        <h4 class="mb-0 text-warning text-capitalize">{{ exercise.name  }}</h4>
                    </div>
                </div>

            </div>
        </div>
    </div>

</template>

<script>
import {onMounted, ref, watch} from "vue";
// import useExercises from "../../composables/Exercise/exercise";

import useCategory from "../../composables/Exercise/category";
import {useRoute} from "vue-router";

export default {

    setup() {

        const route = useRoute()
        const search_exercises = ref('')
        const {getCategoryExercises, categoryExercises} = useCategory()

        onMounted(() => {
            getCategoryExercises(route.params.category_id);
        });


        watch(search_exercises, () => {
            getCategoryExercises(
                route.params.category_id,search_exercises.value,
            )
        })
        return {search_exercises, categoryExercises }
    },

}
</script>
