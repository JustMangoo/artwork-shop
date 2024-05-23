<template>
    <MainLayout>
        <div class="success-container">
            <h1>Paldies Jums!</h1>
            <p>
                Jūsu maksājums tika veiksmīgi apstrādāts. Drīzumā saņemsit
                apstiprinājuma e-pasta ziņojumu.
            </p>
            <button class="w-full btn-primary" @click="goToHome">
                Atgriezties uz sākumlapu
            </button>
        </div>
    </MainLayout>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout.vue";

export default {
    components: {
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
    background-color: var(--color--light);
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);

    h1 {
        color: var(--color--dark);
    }

    p {
        font-size: 1.2rem;
        color: #333;
        margin: 20px 0;
    }
}
</style>
