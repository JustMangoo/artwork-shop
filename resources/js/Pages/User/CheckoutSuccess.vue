<template>
    <MainLayout>
        <div class="success-container">
            <h1>Paldies Jums!</h1>
            <p>
                Jūsu maksājums tika veiksmīgi apstrādāts. Drīzumā saņemsit
                apstiprinājuma e-pasta ziņojumu.
            </p>
            <PrimaryButton @click="goToHome"
                >Atgriezties uz sākumlapu</PrimaryButton
            >
        </div>
    </MainLayout>
</template>

<script>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import MainLayout from "@/Layouts/MainLayout.vue";

export default {
    components: {
        PrimaryButton,
        MainLayout,
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
    background-color: var(--light);
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);

    h1 {
        color: var(--dark);
    }

    p {
        font-size: 1.2rem;
        color: #333;
        margin: 20px 0;
    }
}
</style>
