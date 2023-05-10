<template>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-xl-4 row-cols-xxl-4">

        <div class="d-flex align-items-center mb-4">
            <div>
                <h1>Clients</h1>
            </div>


            <div class="text-warning ms-auto">
                <router-link :to="{name: 'client.create'}"
                             class=" btn btn-outline-warning px-0 radius-30 border-0">
                    <span class="font-30 material-symbols-outlined font-40">add</span>
                </router-link>
            </div>
        </div>


        <div class="col" v-for="client in clients">
            <div class="card radius-10 border-0 border-start border-warning border-4">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <p class="mb-1">{{client.name}}</p>
                            <h4 class="mb-0 text-warning">{{client.email}}</h4>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>
<script>
import {onMounted} from "vue";
import useClients from "../../composables/client";

export default {
    setup() {
        const {clients, getClients} = useClients()
        onMounted(getClients)
        return {clients}
    },

}
</script>
