<template>
    <div class="container">
        <div class="row justify-content-center mt-1">
            <div class="col-md-8 mt-5">
                <div class="text-center">
                    <h1 class="display-4">{{ greeting }}</h1>
                    <p class="lead">{{ message }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            greeting: 'Welcome to Vue.js with Bootstrap!',
            message: 'Thank you for using ChatGPT.',
        };
    },
};
</script>
