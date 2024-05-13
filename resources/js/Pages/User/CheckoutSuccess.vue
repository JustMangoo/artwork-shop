<template>
    <div class="success-container">
        <h1>Thank You!</h1>
        <p>
            Your payment was successfully processed. You will receive an email
            confirmation shortly.
        </p>
        <PrimaryButton @click="goToHome">Return to Homepage</PrimaryButton>
    </div>
</template>

<script>
import PrimaryButton from "@/Components/PrimaryButton.vue";

export default {
    components: {
        PrimaryButton,
    },
    methods: {
        goToHome() {
            this.$inertia.visit("/");
        },
    },
};
</script>

<style scoped>
.success-container {
    max-width: 600px;
    margin: 50px auto;
    text-align: center;
    padding: 20px;
    border-radius: 8px;
    background-color: #f0f4f8;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);

    h1 {
        color: #4caf50;
    }

    p {
        font-size: 1.2rem;
        color: #333;
        margin: 20px 0;
    }
}
</style>
