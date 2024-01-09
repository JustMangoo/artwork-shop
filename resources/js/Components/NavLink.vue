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

<style lang="scss">
.activeLink {
    display: inline-flex;
    align-items: center;
    padding: 0.25rem 0.25rem;
    border-bottom: 3px solid var(--primary);
    font-size: 0.875rem;
    font-weight: 500;
    line-height: 1.25;
    color: #1a202c;
    &:focus {
        outline: none;
        border-color: var();
    }
    transition: all 0.15s ease-in-out;
}

.inactiveLink {
    display: inline-flex;
    align-items: center;
    padding: 0.25rem 0.25rem;
    border-bottom: 2px solid transparent;
    font-size: 0.875rem;
    font-weight: 500;
    line-height: 1.25;
    color: #a0aec0;
    &:hover {
        color: #4a5568;
        border-color: #e2e8f0;
    }
    &:focus {
        outline: none;
        color: #4a5568;
        border-color: #e2e8f0;
        transition: all 0.15s ease-in-out;
    }
}
</style>
