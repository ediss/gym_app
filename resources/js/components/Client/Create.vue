<template>
    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4 text-warning text-center">Add New Client</h5>
                    <form @submit.prevent = "createClient(client)"
                          class="row g-3">

                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <input v-model="client.name" type="text" placeholder="Name" class="form-control">
                            </div>

                            <div class="text-danger">
                                <div v-for="message in validationErrors?.name">
                                    {{ message }}
                                </div>
                            </div>

                        </div>

                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <input v-model="client.email" type="email" placeholder="E-mail address" class="form-control">
                            </div>

                            <div class="text-danger">
                                <div v-for="message in validationErrors?.email">
                                    {{ message }}
                                </div>
                            </div>

                        </div>


                        <div class="col-12">
                            <div class="col-md-12 mt-5 px-3">
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
import {reactive} from "vue";
import useClients from "../../composables/client";

export default {
    setup() {
        const client = reactive({
            name : '',
            email : '',
            role_id: 5
        })

        const { createClient, validationErrors } = useClients()

        return { client, createClient, validationErrors}
    },

}
</script>
