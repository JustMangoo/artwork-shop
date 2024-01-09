<template>
    <div class="guestContainer">
        <Navigation />
        <div>
            <Link href="/">
                <ApplicationLogo class="logo" />
            </Link>
        </div>

        <div class="content">
            <slot />
        </div>
    </div>
</template>

<style lang="scss" scoped>
.guestContainer {
    display: flex;
    flex-direction: column;
    align-items: center;
    min-height: 100vh;
    padding-top: 1.5rem;
    background-color: #f7fafc;

    @media (min-width: 640px) {
        justify-content: center;
        padding-top: 0;
    }

    .logo {
        width: 5rem;
        height: 5rem;
        color: #a0aec0;
    }

    .content {
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
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
import Navigation from "@/Components/Navigation.vue";
</script>
