import {ref} from "vue";
import {useRouter} from "vue-router";
export default function useClients() {
    const clients = ref([])
    const router = useRouter()
    const validationErrors = ref({})
    const getClients = async () => {
        axios.get('api/get-clients')
            .then(response => clients.value = response.data.data)
            .catch(error => console.log(error))
    }

    const createClient = async (client) => {
        axios.post('api/create-client', client)
            .then(response => {
                router.push({name: 'clients.index'})
            })
            .catch(error => {
                if(error.response?.data) {
                    validationErrors.value = error.response.data.errors;

                    console.log(validationErrors);
                }
            })
    }


    return {
        clients,
        getClients,
        createClient,
        validationErrors,
    }
}
