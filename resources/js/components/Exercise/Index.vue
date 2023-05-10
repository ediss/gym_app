`<template>
    <div class="row">

        <div class="d-flex align-items-center mb-4 col-12">
            <div>
                <h1 class="m-0">Exercises</h1>
            </div>


            <div class="text-success ms-auto">
                <router-link :to="{name: 'exercise.create'}"
                             class=" btn btn-outline-warning px-0 radius-30 border-0">
                    <span class="font-30 material-symbols-outlined font-40">add</span>
                </router-link>
            </div>
        </div>

        <div class="col-12 mb-4">
            <input v-model="search_exercises" type="text" class="form-control" placeholder="Search...">
        </div>
        <div class="col-12" id="categories-card" v-show="search_exercises.length === 0">
            <div class="card" >
            <div class="card-body">
                <ul class="list-group list-group-flush">



                    <router-link v-for="category in exerciseCategories"
                                 :to="{ name: 'category.exercises', params: {category_id: category.id} }"
                        class="list-group-item">
                        <li class="d-flex justify-content-between align-items-center">
                            <!-- Render the item content here -->
                            {{ category.name }}

                            <span class="badge border border-warning rounded-pill font-15 ">{{ category.exercises_count }}</span>
                        </li>
                    </router-link>

                </ul>
            </div>
        </div>
        </div>

        <div class="col-12" v-for="exercise in exercises" v-show="search_exercises !== ''">
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
    </div>
</template>
<script>
import {onMounted, reactive, ref, watch} from "vue";
import useExercises from "../../composables/Exercise/exercise";

import useCategory from "../../composables/Exercise/category";

export default {
    setup() {

        const category = reactive({id: ''});

        const search_exercises = ref('')


        const {
            exercises,
            getExercises,
        } = useExercises();


        const {
            exerciseCategories,
            getExerciseCategories,
        } = useCategory()



        onMounted(() => {
            getExercises();
            getExerciseCategories();
        });


        watch(search_exercises, () => {
            getExercises(
                search_exercises.value,
            )
        })


        return { search_exercises, category, exercises, exerciseCategories}
    },
}
</script>

<style>
.font-15 {
    font-size: 15px;
}
</style>
