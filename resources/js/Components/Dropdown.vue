<template>
    <div ref="dropdownContainer" class="dropdown-container">
        <button class="label" @click.stop="toggleDropdown">
            <slot name="dropdown-label">Dropdown</slot>
        </button>
        <transition name="fade">
            <div v-show="isOpen" class="dropdown-content" @click.stop>
                <slot name="link-container">Default</slot>
            </div>
        </transition>
    </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from "vue";

const isOpen = ref(false);
const dropdownContainer = ref(null);

function toggleDropdown() {
    isOpen.value = !isOpen.value;
}

function closeDropdown() {
    isOpen.value = false;
}

function handleClickOutside(event) {
    if (
        dropdownContainer.value &&
        !dropdownContainer.value.contains(event.target)
    ) {
        closeDropdown();
    }
}

onMounted(() => {
    window.addEventListener("click", handleClickOutside);
});

onUnmounted(() => {
    window.removeEventListener("click", handleClickOutside);
});
</script>

<style lang="scss" scoped>
.dropdown-container {
    display: inline-block;
    cursor: pointer;
    position: relative;
}

.label {
    display: flex;
    align-items: center;
    border: none;
    padding: 0;
    color: white;
}

.dropdown-content {
    position: absolute;
    min-width: 100px;
    background-color: white;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: var(--border-rad);
    padding: 0.5rem;
    z-index: 20;
    top: 100%;
    right: 0;
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
