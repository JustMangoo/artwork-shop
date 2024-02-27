<template>
    <div v-if="showModal" class="modal-overlay">
        <div class="modal">
            <div class="modal-header">
                <slot name="header"><h2>Add new Product</h2></slot>
                <button class="close-btn" @click="closeModal">
                    <img src="../Assets/xmark.svg" alt="close-icon" />
                </button>
            </div>
            <section class="modal-body">
                <slot name="body"></slot>
            </section>
            <div class="modal-footer">
                <slot name="footer"> </slot>
            </div>
        </div>
    </div>
</template>

<script>
import BasicButton from "../Components/BasicButton.vue";

export default {
    components: {
        BasicButton,
    },
    props: {
        showModal: Boolean,
    },
    methods: {
        closeModal() {
            this.$emit("update:showModal", false);
        },
        submit() {
            this.$emit("submit");
        },
    },
};
</script>

<style scoped>
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal {
    background: white;
    padding: 1.5rem;
    border-radius: 4px;
    max-width: 40rem;
    width: 100%;
    max-height: 100vh;
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.close-btn {
    background: var(--primary);
    border: none;
    font-size: 1.5rem;
    border-radius: 50%;
    padding: 2px;
}

.close-btn img {
    height: 1.5rem;
}

.modal-body {
    margin-bottom: 20px;
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.modal-footer {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
}
</style>
