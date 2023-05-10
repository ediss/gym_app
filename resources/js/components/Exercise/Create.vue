<template>
    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4 text-warning text-center">Add New Exercise</h5>
                    <form @submit.prevent = "createExercise(exercise)"
                          class="row g-3">

                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <input v-model="exercise.name" type="text" placeholder="Name" class="form-control">
                            </div>

                            <div class="text-danger">
                                <div v-for="message in validationErrors?.name">
                                    {{ message }}
                                </div>
                            </div>

                        </div>

                        <div class="col-12">
                            <div class="input-group mb-3">
                            <select v-model = "exercise.exercise_category_id" class="form-select">
                                <option disabled value="">Choose Category</option>
                                <option v-for="category in exerciseCategories" :value="category.id">
                                    {{ category.name }}
                                </option>
                            </select>
                            </div>

                            <div class="text-danger">
                                <div v-for="message in validationErrors?.exercise_category_id">
                                    {{ message }}
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="input-group mb-3">
                            <select v-model="exercise.exercise_type_id" class="form-select">
                                <option disabled value="">Choose Type</option>

                                <option v-for="type in exerciseTypes" :value="type.id">
                                    {{ type.name }}
                                </option>
                            </select>
                            </div>

                            <div class="text-danger">
                                <div v-for="message in validationErrors?.exercise_type_id">
                                    {{ message }}
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <textarea rows="4" v-model="exercise.note" class="form-control" placeholder="Exercise Note"></textarea>

                        </div>

                        <div class="col-12">
                            <div class="col-md-12 mt-3 px-3">
                                <button class="btn btn-warning px-5 w-100">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</template>


<script>
import {onMounted, reactive, ref} from "vue";
import useExercises from "../../composables/Exercise/exercise";
import useCategory from "../../composables/Exercise/category";

export default {
    setup() {
        const exercise = reactive({
            name : '',
            exercise_type_id: '',
            exercise_category_id: '',
            video_src: '',
            note: ''
        });

        const {
            exerciseTypes,
            getExerciseTypes,
            createExercise,
            validationErrors

        } = useExercises();



        const {
            exerciseCategories,
            getExerciseCategories,

        } = useCategory();

        onMounted(() => {
            getExerciseCategories();
            getExerciseTypes();
        });

        return {exercise, createExercise, exerciseCategories, exerciseTypes, validationErrors}
    },
}
</script>
