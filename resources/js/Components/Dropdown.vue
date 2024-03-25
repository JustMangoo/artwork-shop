<template>
    <div @click="open = !open" v-bind="$attrs">
        <div class="dropdown-container">
            <button type="button" class="label">
                <!-- {{ $page.props.auth.user.name }} -->
                <slot name="dropdown-label" />
            </button>
        </div>
    </div>

    <!-- Full Screen Dropdown Overlay -->
    <div v-show="open" class="fixed inset-0 z-40" @click="open = false"></div>

    <Transition>
        <div
            v-show="open"
            class="boxs"
            :class="[alignmentClasses]"
            style="display: none"
            @click="open = false"
        >
            <slot name="link-container" />
        </div>
    </Transition>
</template>

<script setup>
import { computed, onMounted, onUnmounted, ref } from "vue";

const props = defineProps({
    align: {
        type: String,
        default: "right",
    },

    width: {
        type: String,
        default: "48",
    },

    contentClasses: {
        type: String,
        default: "py-1 bg-white",
    },
});

const closeOnEscape = (e) => {
    if (open.value && e.key === "Escape") {
        open.value = false;
    }
};

onMounted(() => document.addEventListener("keydown", closeOnEscape));
onUnmounted(() => document.removeEventListener("keydown", closeOnEscape));

const widthClass = computed(() => {
    return {
        48: "w-48",
    }[props.width.toString()];
});

const alignmentClasses = computed(() => {
    if (props.align === "left") {
        return "ltr:origin-top-left rtl:origin-top-right start-0";
    } else if (props.align === "right") {
        return "ltr:origin-top-right rtl:origin-top-left end-0";
    } else {
        return "origin-top";
    }
});

const open = ref(false);
</script>

<style lang="scss" scoped>
.dropdown-container {
    .label {
        display: flex;
        color: var(--primary);
        font-weight: 300;
        padding: 0;
        .dropdown-arrow {
            transform: rotate(180deg);
            display: none;
        }
        &:hover,
        &:focus {
            .dropdown-arrow {
                transform: rotate(0);
            }
        }
    }
    .v-enter-active {
        transition: all 200ms ease-out;
    }

    .v-leave-active {
        transition: all 75ms ease-in;
    }

    .v-enter-from,
    .v-leave-to {
        transform: scale(0.95);
        opacity: 0;
    }

    .v-enter-to,
    .v-leave-from {
        transform: scale(1);
        opacity: 100;
    }
}
.boxs {
    position: absolute;
    z-index: 50;
    width: 12rem; // Assuming 1rem = 4px, so w-48 = 48 / 4 = 12rem
    margin-top: 0.5rem; // mt-2 = 0.5rem
    background-color: #ffffff; // bg-white
    border-radius: 0.375rem; // rounded-md
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
        0 2px 4px -1px rgba(0, 0, 0, 0.05); // shadow-lg
}

.link-container {
    display: flex;
    flex-direction: column;
    gap: 1;
    border-radius: 0.375rem;
    padding: 0.25rem 0;
    background-color: #fff;
}
</style>
