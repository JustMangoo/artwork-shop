<template>
    <MainLayout>
        <Head title="Log in" />
        <div class="box">
            <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
                {{ status }}
            </div>

            <form @submit.prevent="submit">
                <div>
                    <InputLabel for="email" value="Epasts" />

                    <TextInput
                        id="email"
                        type="email"
                        class="block w-full mt-1"
                        v-model="form.email"
                        required
                        autofocus
                        autocomplete="username"
                    />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mt-4">
                    <InputLabel for="password" value="Parole" />

                    <TextInput
                        id="password"
                        type="password"
                        class="block w-full mt-1"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                    />

                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="options-container">
                    <label class="flex items-center">
                        <Checkbox
                            name="remember"
                            v-model:checked="form.remember"
                        />
                        <span class="text-sm text-gray-600 ms-2"
                            >Atcerēties mani</span
                        >
                    </label>

                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Aizmirsi savu paroli?
                    </Link>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <PrimaryButton
                        class="w-full"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Pieslēdzies
                    </PrimaryButton>
                </div>
            </form>
            <div class="divider">Vai</div>
            <Link :href="route('register')">
                <SecondaryButton
                    class="w-full"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Reģisterējies
                </SecondaryButton>
            </Link>
        </div>
    </MainLayout>
</template>

<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import MainLayout from "@/Layouts/MainLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import SecondaryButton from "@/Components/SecondaryButton.vue";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<style lang="scss" scoped>
.box {
    width: 100%;
    padding: 1.5rem;
    margin-top: 1.5rem;
    background-color: #fff;
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);

    @media (min-width: 640px) {
        max-width: 28rem;
        border-radius: 0.5rem;
    }
    .options-container {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        margin-top: 1rem;
    }
}
</style>
