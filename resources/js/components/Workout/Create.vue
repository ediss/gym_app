<template>
    Start workout for {{clientName}}

<!--    {{ client_name }}-->
</template>
<script>
import useWorkout from "../../composables/workout";
import useClient from "../../composables/client";
import {onMounted} from "vue";

export default {
    props: {
        clientId: {
            type: String,
            required: true
        },
        clientName: {
            type: String,
            required: true
        }
    },
    setup(props) {
        const {client, getClient} = useWorkout()
        onMounted(getClient(props.clientId))

        return {workout}
    }
}
</script>
<!--<script>-->
<!--export default {-->
<!--    props: {-->
<!--        clientId: {-->
<!--            type: String,-->
<!--            required: true-->
<!--        },-->
<!--        clientName: {-->
<!--            type: String,-->
<!--            required: true-->
<!--        }-->
<!--    },-->
<!--    data() {-->
<!--        return {-->
<!--            localClientName: ''-->
<!--        };-->
<!--    },-->
<!--    created() {-->
<!--        // Retrieve clientName from localStorage on component creation-->
<!--        if (!this.clientName && localStorage.getItem('clientName')) {-->
<!--            this.localClientName = localStorage.getItem('clientName');-->
<!--        }-->
<!--    },-->
<!--    computed: {-->
<!--        // Computed property to get the clientName from prop or local data-->
<!--        clientName() {-->
<!--            return this.clientName || this.localClientName;-->
<!--        }-->
<!--    },-->
<!--    watch: {-->
<!--        // Watch for changes in clientName prop and update local data and localStorage-->
<!--        clientName(newVal) {-->
<!--            this.localClientName = newVal;-->
<!--            localStorage.setItem('clientName', newVal);-->
<!--        }-->
<!--    }-->
<!--}-->
<!--</script>-->
