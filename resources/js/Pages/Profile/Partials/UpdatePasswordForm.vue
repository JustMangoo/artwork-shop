<template>
    <section class="profile-section">
        <header>
            <h4>Paroles atjaunināšana</h4>

            <p class="header-description">
                Pārliecinieties, ka jūsu kontā tiek izmantota gara, nejauši
                izvēlēta parole, lai nodrošinātu drošību.
            </p>
        </header>

        <form @submit.prevent="updatePassword" class="update-password-form">
            <div class="form-group">
                <InputLabel for="current_password" value="Pašreizējā parole" />
                <input
                    id="current_password"
                    ref="currentPasswordInput"
                    v-model="form.current_password"
                    type="password"
                    class="form-input"
                    autocomplete="current-password"
                />
                <InputError
                    :message="form.errors.current_password"
                    class="input-error"
                />
            </div>

            <div class="form-group">
                <InputLabel for="password" value="Jaunā parole" />
                <input
                    id="password"
                    ref="passwordInput"
                    v-model="form.password"
                    type="password"
                    class="form-input"
                    autocomplete="new-password"
                />
                <InputError
                    :message="form.errors.password"
                    class="input-error"
                />
            </div>

            <div class="form-group">
                <InputLabel
                    for="password_confirmation"
                    value="Apstiprināt paroli"
                />
                <input
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="form-input"
                    autocomplete="new-password"
                />
                <InputError
                    :message="form.errors.password_confirmation"
                    class="input-error"
                />
            </div>

            <div class="form-actions">
                <button :disabled="form.processing">Saglabāt</button>
                <p v-if="form.recentlySuccessful" class="success-message">
                    Saglabāts.
                </p>
            </div>
        </form>
    </section>
</template>

<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: "",
    password: "",
    password_confirmation: "",
});

const updatePassword = () => {
    form.put(route("password.update"), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset("password", "password_confirmation");
                passwordInput.value.focus();
            }
            if (form.errors.current_password) {
                form.reset("current_password");
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<style lang="scss" scoped>
/* Section Styles */
.profile-section {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;

    h4 {
        font-weight: 500;
        color: var(--color--dark);

        .header-description {
            margin-top: 0.25rem;
            color: var(--color--dark);
        }
    }
}

/* Form Styles */
.update-password-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-input {
    width: 100%;
    padding: 0.5rem;
    margin-top: 0.25rem;
    outline: 1px solid #ddd;
    border: none;
    border-bottom: 1px solid var(--dark);
    background-color: transparent;
    font-size: 1rem;
    color: var(--dark);
    transition: all 0.2s ease-in-out;

    &:focus {
        outline: 1px solid var(--primary);
        box-shadow: none;
    }

    &::placeholder {
        color: var(--light-background);
    }
}

.input-error {
    margin-top: 0.5rem;
    color: var(--error-msg); /* Use your error color variable */
}

/* Form Actions Styles */
.form-actions {
    display: flex;
    align-items: center;
    gap: 1rem;

    button {
        // Add your button styles here
    }
}

.success-message {
    color: var(--success-msg); /* Use your success color variable */
}
</style>
