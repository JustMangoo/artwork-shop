<template>
    <MainLayout>
        <Head title="Register" />

        <form @submit.prevent="submit" class="box">
            <div class="input-wrapper">
                <label for="name">Name</label>

                <input
                    id="name"
                    type="text"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError :message="form.errors.name" />
            </div>

            <div class="input-wrapper">
                <label for="email">Email</label>

                <input
                    id="email"
                    type="email"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError :message="form.errors.email" />
            </div>

            <div class="input-wrapper">
                <label for="password">Password</label>

                <input
                    id="password"
                    type="password"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <InputError :message="form.errors.password" />
            </div>

            <div class="input-wrapper">
                <label for="password_confirmation">Apstiprini Password</label>

                <input
                    id="password_confirmation"
                    type="password"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError :message="form.errors.password_confirmation" />
            </div>

            <div class="input-wrapper">
                <Link :href="route('login')"> Esi jau reģisterējies? </Link>
            </div>
            <div class="input-wrapper">
                <button class="w-full btn-primary" :disabled="form.processing">
                    Reģisterēties
                </button>
            </div>
        </form>
    </MainLayout>
</template>

<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import InputError from "@/Components/InputError.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
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
