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
    font-size: 0.9rem;
    font-weight: 400;
    line-height: 1.25;
    color: var(--color--primary);
    transition: all 0.15s ease-in-out;
    height: 100%;
    position: relative;

    &:after,
    &:after {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
        width: 100%;
        content: "";
        color: var(--color--primary);
        background: var(--color--primary);
        height: 2px;
    }
}

// Inactive Link Styles
.inactiveLink {
    display: inline-flex;
    align-items: center;
    padding: 0.25rem;
    font-size: 0.9rem;
    font-weight: 400;
    line-height: 1.25;
    color: var(--color--dark);
    transition: all 0.15s ease-in-out;
    position: relative;

    &:after,
    &:after {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
        width: 0%;
        content: "";
        color: transparent;
        background: var(--color--primary);
        height: 2px;
    }
    &:hover:after {
        width: 100%;
    }
}
</style>
