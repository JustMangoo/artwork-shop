<template>
    <div class="guest-container">
        <Navigation />

        <div class="content">
            <slot />
        </div>
        <FooterSection />
    </div>
</template>

<style lang="scss" scoped>
.guest-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    background-color: var(--color--white);
    min-height: 100vh;
    width: 100%;
    justify-content: space-between;

    .content {
        height: 100%;
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        position: relative;

        @media (min-width: 640px) {
            justify-content: center;
            padding-top: 0;
        }
    }
}
</style>

<script setup>
import Navigation from "@/Components/Navigation.vue";
import FooterSection from "@/Components/FooterSection.vue";
</script>
