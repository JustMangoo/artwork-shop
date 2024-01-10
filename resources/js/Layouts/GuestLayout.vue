<template>
    <div class="guest-container">
        <Navigation />

        <div class="container"></div>
        <div class="box">
            <slot />
        </div>
    </div>
</template>

<style lang="scss" scoped>
.guest-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding-top: 1.5rem;
    background-color: #f7fafc;

    @media (min-width: 640px) {
        justify-content: center;
        padding-top: 0;
    }
    .box {
        width: 100%;
        padding: 1.5rem;
        margin-top: 1.5rem;
        background-color: #fff;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1),
            0 1px 2px 0 rgba(0, 0, 0, 0.06);

        @media (min-width: 640px) {
            max-width: 28rem;
            border-radius: 0.5rem;
        }
    }
}
</style>

<script setup>
import Navigation from "@/Components/Navigation.vue";
</script>
