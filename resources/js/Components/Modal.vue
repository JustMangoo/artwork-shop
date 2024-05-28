<template>
    <div class="modal-overlay" @click.self="closeModal">
        <div class="modal-container" :class="{ 'with-sidebar': showSidebar }">
            <header class="modal-header">
                <slot name="header">
                    <h2>Default Heading</h2>
                    <!-- Default heading if no slot content provided -->
                </slot>
                <button class="close-button" @click="closeModal">
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M6 6L18 18M18 6L6 18"
                            stroke-width="2"
                            stroke-linecap="sharp"
                            stroke-linejoin="sharp"
                        />
                    </svg>
                </button>
            </header>
            <div class="modal-body">
                <div class="content">
                    <slot name="content">
                        <p>Default content</p>
                        <!-- Default content if no slot content provided -->
                    </slot>
                </div>
                <div
                    class="side-content"
                    :class="{ 'no-side-content': !showSidebar }"
                >
                    <slot name="side-content"> </slot>
                </div>
            </div>
            <footer class="modal-footer">
                <slot name="footer">
                    <button class="btn-secondary" @click="closeModal">
                        Cancel
                    </button>
                    <button class="btn-primary" @click="saveChanges">
                        Save
                    </button>
                </slot>
            </footer>
        </div>
    </div>
</template>

<script setup>
import { defineProps, defineEmits } from "vue";

const props = defineProps({
    showSidebar: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(["close", "save"]);

function closeModal() {
    emit("close");
}

function saveChanges() {
    emit("save");
}
</script>

<style lang="scss" scoped>
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.3);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 100;
}

.modal-container {
    background: var(--color--white);
    width: 1000px;
    max-height: 75vh;
    display: grid;
    grid-template-columns: 1fr;
    grid-template-rows: auto 1fr auto;
    gap: 1rem;
    row-gap: 2rem;
    padding: 16px;
    border-radius: var(--rounded-box);
    overflow: auto;

    &.with-sidebar {
        grid-template-columns: 3fr 1fr;
    }

    .modal-header {
        grid-column: 1 / -1;
        display: flex;
        justify-content: space-between;
        align-items: center;

        .close-button {
            padding: 0;
            background-color: transparent;

            svg {
                cursor: pointer;
                width: 30px;
                aspect-ratio: 1/1;
                stroke: var(--color--primary);
            }
        }
    }

    .modal-body {
        display: contents;

        .content {
            border-radius: var(--rounded-box);
            border: 1px solid var(--color--secondary);
            padding: 18px;
        }

        .side-content {
            overflow: hidden;
            text-overflow: ellipsis;
            border-radius: var(--rounded-box);
            border: 1px solid var(--color--secondary);
            padding: 18px;
        }
        .no-side-content {
            display: none;
        }
    }

    .modal-footer {
        height: max-content;
        padding: 16px;
        grid-column: 1 / -1;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        background-color: var(--color--white);
        padding: 0;
    }
}
</style>
