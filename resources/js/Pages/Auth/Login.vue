<template>
    <MainLayout>
        <Head title="Log in" />
        <div class="box">
            <div v-if="status">
                {{ status }}
            </div>

            <form @submit.prevent="submit">
                <div class="input-wrapper">
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

                <div class="input-wrapper">
                    <InputLabel for="password" value="Parole" />

                    <input
                        id="password"
                        type="password"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                    />

                    <InputError :message="form.errors.password" />
                </div>

                <div class="input-wrapper">
                    <div class="options-container">
                        <label>
                            <Checkbox
                                name="remember"
                                v-model:checked="form.remember"
                            />
                            <span>Atcerēties mani</span>
                        </label>

                        <Link
                            v-if="canResetPassword"
                            :href="route('password.request')"
                        >
                            Aizmirsi savu paroli?
                        </Link>
                    </div>
                </div>

                <div>
                    <button
                        class="w-full btn-primary"
                        :disabled="form.processing"
                    >
                        Pieslēdzies
                    </button>
                </div>
            </form>
            <div class="divider">Vai</div>
            <Link :href="route('register')">
                <button
                    class="w-full btn-secondary"
                    :disabled="form.processing"
                >
                    Reģisterējies
                </button>
            </Link>
        </div>
    </MainLayout>
</template>

<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import MainLayout from "@/Layouts/MainLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

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
    margin: 3rem 0;
    background-color: #fff;
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);

    @media (min-width: 640px) {
        max-width: 28rem;
        border-radius: var(--rounded-elem);
    }
    .input-wrapper {
        margin-bottom: 1rem;
        .options-container {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;

            label {
                display: flex;
                flex-direction: row;
                align-items: center;
            }
        }
    }
}
</style>
