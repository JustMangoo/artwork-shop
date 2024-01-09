<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div class="guestContainer">
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
    min-height: 100vh; // min-h-screen
    padding-top: 1.5rem; // pt-6
    background-color: #f7fafc; // bg-gray-100

    @media (min-width: 640px) {
        // sm: breakpoint
        justify-content: center; // sm:justify-center
        padding-top: 0; // sm:pt-0
    }

    .logo {
        width: 5rem; // w-20
        height: 5rem; // h-20
        color: #a0aec0; // text-gray-500
    }

    .content {
        width: 100%; // w-full
        padding: 1.5rem; // px-6 py-4
        margin-top: 1.5rem; // mt-6
        background-color: #fff; // bg-white
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1),
            0 1px 2px 0 rgba(0, 0, 0, 0.06); // shadow-md

        @media (min-width: 640px) {
            // sm: breakpoint
            max-width: 28rem; // sm:max-w-md
            border-radius: 0.5rem; // sm:rounded-lg
        }
    }
}
</style>
