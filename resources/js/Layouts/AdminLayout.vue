<template>
    <div class="guest-container">
        <Navigation />

        <div class="content">
            <slot />
        </div>
        
        <FooterSectionAdmin />
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

    .content {
        height: 100%;
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 3rem;
        align-items: center;
        margin-bottom: auto;

        @media (min-width: 640px) {
            justify-content: center;
            padding-top: 0;
        }
    }
}
</style>

<script setup>
import Navigation from "@/Components/Navigation.vue";
import FooterSectionAdmin from "@/Components/FooterSectionAdmin.vue";
</script>
