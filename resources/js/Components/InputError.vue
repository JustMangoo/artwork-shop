<template>
    <div v-show="message">
        <p class="input-error-message">
            {{ message }}
        </p>
    </div>
</template>

<script setup>
defineProps({
    message: {
        type: String,
    },
});
</script>

<style lang="scss" scoped>
.input-error-message {
    font-size: 0.875rem;
    line-height: 1.25rem;
    color: #dc2626;
}
</style>
