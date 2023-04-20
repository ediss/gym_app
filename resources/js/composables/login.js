// login.js

import axios from 'axios';

export function useLogin(apiUrl) {
    const login = (username, password) => {
        return new Promise((resolve, reject) => {
            // Make API call to login endpoint
            axios.post(`${apiUrl}/login`, { username, password })
                .then(response => {
                    // Handle successful login
                    resolve(response.data);
                })
                .catch(error => {
                    // Handle login error
                    const errorMsg = error.response ? error.response.data.message : 'Failed to login';
                    reject(errorMsg);
                });
        });
    };

    return {
        login
    };
}
