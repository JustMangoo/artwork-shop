<template>
    <Head title="Sveicināti" />

    <MainLayout>
        <CarouselHero />
        <div class="product-showcase-container">
            <h1>Oriģināli</h1>
            <div class="product-showcase"></div>
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
.tools {
    font-size: 0.875rem;
    text-align: center;
    color: #6b7280;
    margin-left: 1rem;
}
.product-showcase-container {
    width: 100%;
    height: 65vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;

    .product-showcase {
        width: 90rem;
        height: 5vh;
        background-color: var(--secondary);
    }
}
@media (min-width: 640px) {
    .tools {
        text-align: end;
        margin-left: 0;
    }
}
</style>
