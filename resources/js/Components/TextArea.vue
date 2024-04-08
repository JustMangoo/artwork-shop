<template>
    <textarea
        class="textArea"
        :value="modelValue"
        :rows="rows"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="textarea"
    >
    </textarea>
</template>

<script setup>
import { onMounted, ref } from "vue";

defineProps({
    modelValue: {
        type: [String, Number, null],
        default: "",
        required: true,
    },
    rows: {
        type: [Number, String],
        default: 3, // Default row count
    },
});

defineEmits(["update:modelValue"]);

const textarea = ref(null);

onMounted(() => {
    if (textarea.value.hasAttribute("autofocus")) {
        textarea.value.focus();
    }
});

defineExpose({ focus: () => textarea.value.focus() });
</script>

<style lang="scss" scoped>
textarea {
    padding: 0.8rem;
    width: 100%;
    outline: 1px solid #ddd;
    border-radius: var(--border-rad);
    resize: none;
    &:focus {
        outline: 1px solid var(--primary);
        box-shadow: none;
    }
}
</style>
