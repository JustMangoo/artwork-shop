<template>
    <Head title="Welcome" />

    <MainLayout>
        <div class="tools">
            Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
        </div>
    </MainLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";

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
@media (min-width: 640px) {
    .tools {
        text-align: end;
        margin-left: 0;
    }
}
</style>
