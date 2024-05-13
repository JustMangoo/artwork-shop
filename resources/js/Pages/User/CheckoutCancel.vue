<template>
    <div class="cancel-container">
        <h1>Payment Canceled</h1>
        <p>
            Your payment was not processed. If this was an error, please try
            again or contact support.
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
.cancel-container {
    max-width: 600px;
    margin: 50px auto;
    text-align: center;
    padding: 20px;
    border-radius: 8px;
    background-color: #fff0f0;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);

    h1 {
        color: #ff5252;
    }

    p {
        font-size: 1.2rem;
        color: #333;
        margin: 20px 0;
    }
}
</style>
