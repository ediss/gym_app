<template>
    <div>
        <h2>Login</h2>
        <form @submit.prevent="login">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" v-model="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" v-model="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</template>

<script>
import { ref } from 'vue';
import axios from 'axios';

export default {
    setup() {
        // Data properties
        const email = ref('');
        const password = ref('');

        // Login method
        const login = async () => {
            try {
                // Perform login logic here, e.g. make API call to Laravel API
                const loginData = {
                    email: email.value,
                    password: password.value
                };
                const response = await axios.post('/api/login', loginData);
                if (response.data.status) {
                    // Handle successful login
                    console.log('User Logged In Successfully');
                    console.log('Token:', response.data.token);
                } else {
                    // Handle login error
                    console.error(response.data.message);
                }
            } catch (error) {
                // Handle login error
                console.error(error);
            }

            // Reset form data
            email.value = '';
            password.value = '';
        };

        return {
            email,
            password,
            login
        };
    }
};
</script>

<style scoped>
.form-group {
    margin-bottom: 1rem;
}
</style>
