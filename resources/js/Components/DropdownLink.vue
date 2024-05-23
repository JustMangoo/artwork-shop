<template>
    <Link :href="href" class="option">
        <slot />
    </Link>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    href: {
        type: String,
        required: true,
    },
});
</script>

<style lang="scss" scoped>
.option {
    color: var(--color--dark);
}
</style>
