<template>
    <button class="PrimaryButton">
        <slot />
    </button>
</template>
<style lang="scss" scoped>
.PrimaryButton {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.5rem 1rem;
    font-size: 0.75rem;
    font-weight: 600;
    letter-spacing: 0.1em;
    color: #fff;
    text-transform: uppercase;
    background-color: var(--primary);
    border: 1px solid transparent;
    border-radius: 4px;
    transition: all 0.15s ease-in-out;

    &:hover {
        background-color: #4a5568;
    }

    &:focus {
        background-color: #4a5568;
        outline: none;
    }

    &:active {
        background-color: #1a202c;
    }
}
</style>
