<template>
    <input
        type="checkbox"
        :value="value"
        v-model="proxyChecked"
        class="checkboxInput"
    />
</template>

<script setup>
import { computed } from "vue";

const emit = defineEmits(["update:checked"]);

const props = defineProps({
    checked: {
        type: [Array, Boolean],
        required: true,
    },
    value: {
        default: null,
    },
});

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        emit("update:checked", val);
    },
});
</script>

<style lang="scss">
.checkboxInput {
    color: var(--color--primary);
    border-color: #d2d6dc;
    border-radius: 0.25rem;
    &:active {
        box-shadow: none;
    }
}
</style>
