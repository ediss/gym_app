<template>
    <div class="row">
        <div class="col-12 mb-4">
            <input v-model="search_exercises" type="text" class="form-control" placeholder="Search...">
        </div>
<!--        {{ appointment[0].coach_name }}-->

        <div class="col-12" id="categories-card"
             v-show="!isLoading && search_exercises.length === 0">
            <div class="card" >
                <div class="card-body">
                    <ul class="list-group list-group-flush">
<!--                                            <router-link v-for="category in exerciseCategories" :to="{ name: 'category.exercises', params: {category_id: category.id} }"-->
<!--                                                         class="list-group-item">-->
<!--                                                <li class="d-flex justify-content-between align-items-center">-->
<!--                                                    {{ category.name }}-->
<!--                                                    <span class="badge border border-warning rounded-pill font-15 ">{{ category.exercises_count }}</span>-->
<!--                                                </li>-->
<!--                                            </router-link>-->

                        <li v-for="category in exerciseCategories"  @click="getCategoryExercisesClick(category.id)"
                            class="d-flex justify-content-between align-items-center list-group-item">
                            {{ category.name }}
                            <span class="badge border border-warning rounded-pill font-15 ">{{ category.exercises_count }}</span>

                        </li>

                    </ul>
                </div>
            </div>
        </div>

        <router-link v-for="exercise in exercises"
                     v-show="search_exercises !== ''"
                     :to="{
                         name: 'workout.create',
                         params: {
                             appointment_id:appointment_id,
                             exercise_id:exercise.id
                         }
                     }"
                     class="col-12">
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
        </router-link>

        <router-link v-for="exercise in categoryExercises"
                     v-show="isLoading && search_exercises.length === 0"
                     :to="{
                         name: 'workout.create',
                         params: {
                             appointment_id:appointment_id,
                             exercise_id:exercise.id
                         }
                     }"
                    class="col-12">
            <div class="card radius-10 border-0 border-start border-warning border-4" @click="test()">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <p class="mb-1 text-white">{{ exercise.category }}</p>
                            <h4 class="mb-0 text-warning text-capitalize">{{ exercise.name  }}</h4>
                        </div>
                    </div>

                </div>
            </div>
        </router-link>

    </div>
</template>
<script>

import {onMounted, reactive, ref, watch} from "vue";
import useExercises from "../../composables/Exercise/exercise";
import useCategory from "../../composables/Exercise/category";
import useAppointments from "../../composables/appointments";

export default {
    props: {

        appointment_id: {
            type: String,
            required: true
        },
    },


    // setup(props) {
    setup(props) {

        const appointmentProp = reactive({
            id : props.appointment_id,
        })

        const category = reactive({id: ''});

        const search_exercises = ref('');

        const isLoading = ref(false);

        const {
            categoryExercises,
            exerciseCategories,
            getExerciseCategories,
            getCategoryExercises,
        } = useCategory();

        const {
            exercises,
            getExercises,
        } = useExercises();

        const {
            appointment,
            getAppointment,
        } = useAppointments();
        //onMounted(getClient(props.clientId))

        onMounted(() => {
            getExercises();
            getExerciseCategories();
            // getAppointment(appointmentProp.id)
            getAppointment(appointmentProp)
        });


        watch(search_exercises, () => {
            getExercises(
                search_exercises.value,
            );
        });


        const getCategoryExercisesClick = async (categoryID) => {
            try {
                isLoading.value = true;
                exercises.value = await getCategoryExercises(categoryID);

            } catch (error) {
                console.error(error);
            }
        };


        const test = async () => {
            //alert("test");
        };


        return { test, appointment, search_exercises, category, exercises, exerciseCategories,  getCategoryExercisesClick, categoryExercises, isLoading }

    }
}
</script>

