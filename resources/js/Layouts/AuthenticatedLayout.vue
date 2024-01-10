<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <Navigation />

            <!-- Page Heading -->
            <header class="bg-white" v-if="$slots.header">
                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>

<script setup>
import Navigation from "@/Components//Navigation.vue";
</script>

<style lang="scss" scoped>
.navigation {
    background-color: var(--secondary);
    border-bottom: 1px solid #f3f4f6;

    .logo {
        display: block;
        width: auto;
        color: var(--neutral-one);
        fill: currentColor;
        height: 2.25rem;
    }
}
</style>
