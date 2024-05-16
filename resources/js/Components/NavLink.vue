<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>

<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() => (props.active ? "activeLink" : "inactiveLink"));
</script>

<style lang="scss" scoped>
// Active Link Styles
.activeLink {
    display: inline-flex;
    align-items: center;
    padding: 0.25rem;
    border-bottom: 3px solid var(--primary);
    font-size: 0.9rem;
    font-weight: 400;
    line-height: 1.25;
    color: var(--primary);
    transition: all 0.15s ease-in-out;
    height: 100%;

    &:focus {
        outline: none;
        border-color: var(--primary);
    }
}

// Inactive Link Styles
.inactiveLink {
    display: inline-flex;
    align-items: center;
    padding: 0.25rem;
    border-bottom: 2px solid transparent;
    font-size: 0.9rem;
    font-weight: 300;
    line-height: 1.25;
    color: var(--primary);
    transition: all 0.15s ease-in-out;

    &:hover,
    &:focus {
        outline: none;
        border-color: var(--primary);
    }
}
</style>
