<template>
    <input
        class="textInput"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="input"
    />
</template>

<script setup>
import { onMounted, ref } from "vue";

defineProps({
    modelValue: {
        type: [String, Number, null],
        default: "",
        required: true,
    },
});

defineEmits(["update:modelValue"]);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute("autofocus")) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<style lang="scss" scoped>
input {
    padding: 0.5rem;
    width: 100%;
    outline: 1px solid #ddd;
    border-radius: var(--border-rad);
    &:focus {
        outline: 1px solid var(--primary);
        box-shadow: none;
    }
}
</style>
