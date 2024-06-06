<template>
    <div
        v-if="visible"
        :class="['message', type, { 'slide-in': slideIn }]"
        @click="hide"
    >
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
            slideIn: false,
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
                this.slideIn = true;
            }, 1);
            setTimeout(() => {
                this.hide();
            }, 4000);
        },
        hide() {
            this.slideIn = false;
            setTimeout(() => {
                this.visible = false;
            }, 300);
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
    top: 15%;
    right: -40%;
    padding: 0.5rem 1rem;
    border-radius: var(--rounded-elem);
    background-color: var(--color--white);
    font-weight: 700;
    color: var(--color--dark);
    border-left: 3px solid var(--color--info);
    transition: all 1s ease;
    cursor: pointer;
    z-index: 1000;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transform: translateX(0);

    &.slide-in {
        right: 0;
    }
}
.message.success {
    border-color: var(--color--success);
}
.message.error {
    border-color: var(--color--error);
}
.message.warning {
    border-color: var(--color--warning);
}
</style>
