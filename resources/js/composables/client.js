import {ref} from "vue";

export default function useClients() {
    const clients = ref([])
    const getClients = async () => {
        axios.get('api/get-clients')
            .then(response => clients.value = response.data.data)
            .catch(error => console.log(error))
    }


    return {
        clients,
        getClients,
    }
}
