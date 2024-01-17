<template>
    <div class="guest-container">
        <Navigation />

        <div class="content">
            <slot />
        </div>
    </div>
</template>

<style lang="scss" scoped>
.guest-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    background-color: #f7fafc;
    min-height: 100vh;

    .content {
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;

        @media (min-width: 640px) {
            justify-content: center;
            padding-top: 0;
        }
    }
}
</style>

<script setup>
import Navigation from "@/Components/Navigation.vue";
</script>
