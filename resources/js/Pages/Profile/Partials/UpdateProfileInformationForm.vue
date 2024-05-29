<template>
    <section class="profile-section">
        <header>
            <h4>Profila informācija</h4>

            <p class="header-description">
                Atjauniniet konta profila informāciju un e-pasta adresi.
            </p>
        </header>

        <form
            @submit.prevent="form.patch(route('profile.update'))"
            class="profile-info-form"
        >
            <div class="form-group">
                <InputLabel for="name" value="Vārds" />
                <input
                    id="name"
                    type="text"
                    class="form-input"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />
                <InputError class="input-error" :message="form.errors.name" />
            </div>

            <div class="form-group">
                <InputLabel for="email" value="Epasts" />
                <input
                    id="email"
                    type="email"
                    class="form-input"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />
                <InputError class="input-error" :message="form.errors.email" />
            </div>

            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="email-unverified-message">
                    Jūsu e-pasta adrese nav verificēta.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="verification-link"
                    >
                        Noklikšķiniet šeit, lai atkārtoti nosūtītu verifikācijas
                        e-pasta vēstuli.
                    </Link>
                </p>

                <div
                    v-show="status === 'verification-link-sent'"
                    class="verification-sent-message"
                >
                    Uz jūsu e-pasta adresi ir nosūtīta jauna verifikācijas
                    saite.
                </div>
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
import { Link, useForm, usePage } from "@inertiajs/vue3";

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
});
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

/* Header Styles */

/* Form Styles */
.profile-info-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-input {
    // ... (same as in the previous response)
}

.input-error {
    margin-top: 0.5rem;
    color: var(--error-msg);
}

/* Email Verification Styles */
.email-unverified-message {
    margin-top: 0.5rem;
    color: var(--gray-800);
}

.verification-link {
    font-size: 0.875rem; /* text-sm */
    color: var(--gray-600);
    text-decoration: underline;

    &:hover {
        color: var(--gray-900);
    }
}

.verification-sent-message {
    margin-top: 0.5rem;
    font-size: 0.875rem;
    font-weight: 500; /* font-medium */
    color: var(--green-600); /* Replace with your green success color */
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
    color: var(--success-msg);
}
</style>
