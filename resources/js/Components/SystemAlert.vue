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
            default: "message", // or 'success', 'error', 'warning'
        },
        uniqueKey: {
            type: Number,
            required: false,
            default: () => Date.now(),
        },
    },
    data() {
        return {
            visible: false,
        };
    },
    watch: {
        uniqueKey(newKey, oldKey) {
            if (newKey !== oldKey) {
                this.show();
            }
        },
    },
    methods: {
        show() {
            this.visible = true;
            setTimeout(() => {
                this.hide();
            }, 3000); // Automatically hide after 3 seconds
        },
        hide() {
            this.visible = false;
        },
    },
    mounted() {
        if (this.message != "") {
            this.show();
        }
    },
};
</script>

<style lang="scss" scoped>
.message {
    position: fixed;
    bottom: 10%;
    right: 50%;
    transform: translateX(50%);
    padding: 0.5rem 1rem;
    border-radius: var(--rounded-box);
    color: var(--color--dark);
    font-weight: 700;
    background-color: rgba(var(--color--info), 0.8);
    transition: all 1s ease;
    cursor: pointer;
    z-index: 1000;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
.message.success {
    background-color: rgba(var(--color--success), 0.8);
    color: var(--color--dark);
}
.message.error {
    background-color: rgba(var(--color--error), 0.8);
    color: var(--color--dark);
}
.message.warning {
    background-color: rgba(var(--color--warning), 0.8);
    color: var(--color--dark);
}
</style>
