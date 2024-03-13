<template>
    <div v-if="visible" :class="['message', type]" @click="hide">
        {{ message }}
    </div>
</template>

<script>
export default {
    props: {
        message: String,
        type: {
            type: String,
            default: "info", // or 'success', 'error', 'warning'
        },
    },
    data() {
        return {
            visible: false,
        };
    },
    methods: {
        show() {
            this.visible = true;
            setTimeout(this.hide, 3000); // Auto-hide after timer
        },
        hide() {
            this.visible = false;
        },
    },
    watch: {
        message(newValue, oldValue) {
            if (newValue !== oldValue && newValue !== "") {
                this.show();
            }
        },
    },
};
</script>

<style lang="scss" scoped>
.message {
    position: fixed;
    bottom: 2rem;
    right: 50%;
    transform: translateX(50%);
    padding: 0.5rem 1rem;
    border-radius: var(--border-rad);
    color: white;
    font-weight: 700;
    background-color: var(--secondary);
    transition: all 1s ease;
    cursor: pointer;
    z-index: 1000;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
.message.success {
    background-color: var(--success-msg);
}
.message.error {
    background-color: var(--error-msg);
    color: black;
}
.message.warning {
    background-color: var(--warning-msg);
    color: black;
}
</style>
