<template>
    <MainLayout>
        <div class="box">
            <Head title="Aizmirsta Parole" />

            <div>
                Aizmirsāt paroli? Vienkārši norādiet savu e-pasta adresi, un mēs
                nosūtīsim jums paroles atiestatīšanas saiti, kas ļaus jums
                iestatīt jaunu paroli.
            </div>

            <div v-if="status">
                {{ status }}
            </div>

            <form @submit.prevent="submit">
                <div>
                    <InputLabel for="email" value="Epasts" />

                    <input
                        id="email"
                        type="email"
                        v-model="form.email"
                        required
                        autofocus
                        autocomplete="username"
                    />

                    <InputError :message="form.errors.email" />
                </div>

                <div>
                    <button
                        class="w-full btn-primary"
                        :disabled="form.processing"
                    >
                        Saņēmt saiti
                    </button>
                </div>
            </form>
        </div>
    </MainLayout>
</template>

<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import { Head, useForm } from "@inertiajs/vue3";

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: "",
});

const submit = () => {
    form.post(route("password.email"));
};
</script>

<style lang="scss" scoped>
.box {
    width: 100%;
    padding: 1.5rem;
    margin: 3rem 0;
    background-color: #fff;
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
    display: flex;
    flex-direction: column;
    gap: 0.5rem;

    @media (min-width: 640px) {
        max-width: 28rem;
        border-radius: 0.5rem;
    }
}
</style>
