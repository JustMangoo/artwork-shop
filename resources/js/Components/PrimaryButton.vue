<template>
    <button class="primary-btn btn-2">
        <slot />
    </button>
</template>
<style lang="scss" scoped>
.primary-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.5rem;
    font-size: 1rem;
    font-weight: 500;
    letter-spacing: 0.1em;
    color: var(--neutral-one);
    text-transform: uppercase;
    background-color: var(--primary);
    border: 1px solid transparent;
    border-radius: 4px;
    transition: all 0.15s ease-in-out;

    &::before,
    &::after {
        border-top: 0.5px solid rgba(#fff, 0);
        bottom: 0px;
        content: " ";
        display: block;
        margin: 0 auto;
        width: 0;
        transition: all 280ms ease-in-out;
        margin: 0 6rem;
    }

    &:hover {
        letter-spacing: 4px;
    }

    &:hover:before,
    &:hover:after {
        border-top: 0.5px solid rgba(#fff, 1);
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
