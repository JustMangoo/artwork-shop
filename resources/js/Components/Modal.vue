<template>
    <Teleport to="body">
        <div v-show="show" class="modal-overlay" scroll-region>
            <div v-show="show" class="modal-backdrop" @click="close">
                <div class="backdrop" />
            </div>

            <div v-show="show" class="modal-content" :class="maxWidthClass">
                <slot v-if="show" />
            </div>
        </div>
    </Teleport>
</template>

<script setup>
import { onMounted, onUnmounted, watch } from "vue";

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: "2xl",
    },
    closeable: {
        type: Boolean,
        default: true,
    },
});

const emit = defineEmits(["close"]);

watch(
    () => props.show,
    () => {
        if (props.show) {
            document.body.style.overflow = "hidden";
        } else {
            document.body.style.overflow = null;
        }
    }
);

const close = () => {
    if (props.closeable) {
        emit("close");
    }
};

const closeOnEscape = (e) => {
    if (e.key === "Escape" && props.show) {
        close();
    }
};

onMounted(() => document.addEventListener("keydown", closeOnEscape));

onUnmounted(() => {
    document.removeEventListener("keydown", closeOnEscape);
    document.body.style.overflow = null;
});
</script>

<style lang="scss" scoped>
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 50;
    background-color: rgba(black, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1.5rem 1rem;
    overflow-y: auto;
    width: 100%;
    height: 100%;
}

.modal-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    transition: all 0.2s;
}

.backdrop {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
}

/* Modal Content */
.modal-content {
    background-color: white;
    padding: 16px;
    border-radius: 0.5rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
        0 2px 4px -1px rgba(0, 0, 0, 0.06);
    transition: all 0.3s;
    max-width: 45vw;
    width: auto;

    @media (min-width: 640px) {
        // Optionally adjust width on larger screens
        // Example: max-width: 42rem;
    }
}

/* Responsive Max-Width Classes */
// These classes will remain the same, based on your `maxWidth` prop.
.sm-max-w-sm {
    @media (min-width: 640px) {
        max-width: 24rem;
    }
}
</style>
