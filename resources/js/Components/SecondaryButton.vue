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
    font-weight: 300;
    letter-spacing: 0.1em;
    color: var(--primary);
    text-transform: uppercase;
    background-color: transparent;
    border: 1px solid var(--primary);
    border-radius: var(--border-rad);
    transition: all 0.3s ease-in-out;
    width: 100%;
    padding: 0.5rem;
    margin: 0;
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    align-items: center;
    gap: 10px; /* Space between the lines and the text */

    &::before,
    &::after {
        content: "";
        width: 0; /* Fixed width of the line */
        height: 1px; /* Thickness of the line */
        background-color: var(--primary); /* Color of the line */
        transition: all 0.15s ease-in-out;
    }

    &::before {
        justify-self: end;
    }

    &:hover {
        letter-spacing: 0.2em;
    }

    &:hover::before,
    &:hover::after {
        content: "";
        width: 80%; /* Fixed width of the line */
    }
}
</style>
