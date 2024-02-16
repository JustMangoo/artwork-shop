<template>
    <Head title="Sveicināti" />

    <MainLayout>
        <CarouselHero />
        <div class="product-showcase-container">
            <h1>Oriģināli</h1>
            <div class="product-showcase">
                <img class="left" src="../Assets/Images/foto1.webp" alt="" />
                <img class="middle" src="../Assets/Images/foto2.webp" alt="" />
                <img class="right" src="../Assets/Images/foto1.webp" alt="" />
            </div>
        </div>
        <CarouselProducts />
        <div class="tools" hidden>
            Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
        </div>
    </MainLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import CarouselHero from "@/Components/CarouselHero.vue";
import CarouselProducts from "@/Components/CarouselProducts.vue";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<style lang="scss" scoped>
img {
    border: 8px solid var(--primary);
    box-shadow: 0 10px 50px #0000002a;
    object-fit: cover;
}

.tools {
    font-size: 0.875rem;
    text-align: center;
    color: #6b7280;
    margin-left: 1rem;
}
.product-showcase-container {
    width: 100%;
    height: 75vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin: 7rem 0;

    .product-showcase {
        min-width: 10rem;
        width: 100%;
        max-width: 95rem;
        padding-inline: 0.5rem;
        height: 100%;
        background-color: var(--secondary);

        display: flex;
        flex-direction: row;

        align-items: center;

        @media (max-width: 768px) {
            flex-direction: column;
        }

        .left {
            transform: translate(-15%, -25%);
            height: 35rem;
            aspect-ratio: 3 / 4;
        }

        .middle {
            transform: translate(-20%, 15%);
            height: 35rem;
            aspect-ratio: 4 / 3;
        }

        .right {
            transform: translate(-10%, 0);
            height: 35rem;
            aspect-ratio: 3 / 4;
        }
    }
}
@media (min-width: 640px) {
    .tools {
        text-align: end;
        margin-left: 0;
    }
}
</style>
