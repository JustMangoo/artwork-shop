<template>
    <Head title="Panelis" />

    <AdminLayout>
        <div class="container">
            <div class="box">
                <div class="info-text">
                    <h2>{{ $page.props.auth.user.name }}</h2>
                    <p>Lietotājs</p>
                </div>
            </div>
            <div class="box">
                <div class="info-text">
                    <h2>{{ productCount }}</h2>
                    <p>Produktu skaits</p>
                </div>
                <img src="@/Assets/list-white.svg" alt="" class="info-icon" />
            </div>
            <div class="box">
                <div class="info-text">
                    <h2>{{ userCount }}</h2>
                    <p>Lietotāju skaits</p>
                </div>
                <img src="@/Assets/user-white.svg" alt="" class="info-icon" />
            </div>
            <div class="box">
                <div class="info-text">
                    <h2>0</h2>
                    <p>Jaunas ziņas</p>
                </div>
                <img src="@/Assets/mail-white.svg" alt="" class="info-icon" />
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { usePage } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head } from "@inertiajs/vue3";

const { productCount, userCount } = usePage().props;
</script>

<style lang="scss" scoped>
h1 {
    background-color: var(--secondary);
    width: 100%;
    text-align: center;
}

h2 {
    font-size: 1.6rem;
    font-weight: 500;
}

.container {
    max-width: 95rem;
    padding: 0 0.5rem;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-template-rows: 1fr;
    grid-column-gap: 1rem;
    grid-row-gap: 1rem;

    .box {
        padding: 1rem;
        border-radius: var(--border-rad);
        width: 100%;
        background-color: var(--secondary);
        min-height: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-direction: row;

        .info-text {
        }
        .info-icon {
            aspect-ratio: 1/1;
            width: 20%;
            margin-right: 1rem;
            background-color: var(--primary);
            padding: 0.5rem;
            border-radius: 50%;
        }
    }
}
</style>
