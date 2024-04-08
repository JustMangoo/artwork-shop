<template>
    <button class="basic-btn">
        <slot />
    </button>
</template>
<style lang="scss" scoped>
.basic-btn {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0.5rem 1rem;
    font-size: 1rem;
    font-weight: 500;
    letter-spacing: 0.1em;
    color: var(--neutral-one);
    text-transform: uppercase;
    background-color: var(--primary);
    border: 1px solid transparent;
    border-radius: var(--border-rad);
    transition: all 0.15s ease-in-out;
    width: fit-content;
}
</style>
