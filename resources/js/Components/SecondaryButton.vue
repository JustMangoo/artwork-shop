<template>
    <button :type="type" class="secondary-btn">
        <slot />
    </button>
</template>

<script setup>
defineProps({
    type: {
        type: String,
        default: "button",
    },
});
</script>

<style lang="scss" scoped>
.secondary-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.5rem;
    font-size: 1rem;
    font-weight: 500;
    letter-spacing: 0.1em;
    color: var(--primary);
    text-transform: uppercase;
    background-color: transparent;
    border: 1px solid var(--primary);
    border-radius: 2px;
    transition: all 0.15s ease-in-out;

    &::before,
    &::after {
        border-top: 0.5px solid rgba(#abb491, 0);
        bottom: 0px;
        content: " ";
        display: block;
        width: 0;
        transition: all 280ms ease-in-out;
        margin: 0 6rem;
    }

    &:hover {
        letter-spacing: 4px;
    }

    &:hover:before,
    &:hover:after {
        border-top: 0.5px solid rgba(#abb491, 1);
        bottom: 0px;
        content: " ";
        display: block;
        margin: 0 auto;
        width: 100%;
        transition: width 350ms ease-in-out;
        margin: 0 1rem;
    }
}
</style>
