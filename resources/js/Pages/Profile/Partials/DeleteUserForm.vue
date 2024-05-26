<template>
    <section class="profile-section">
        <header>
            <h4>Konta dzēšana</h4>

            <p class="header-description">
                Pēc konta dzēšanas visi tā resursi un dati tiks neatgriezeniski
                dzēsti.
            </p>
        </header>

        <button @click="confirmUserDeletion">Dzēst kontu</button>

        <Modal v-if="confirmingUserDeletion" @close="closeModal">
            <template #header>
                <h4>Vai esat pārliecināts, ka vēlaties dzēst savu kontu?</h4>
            </template>

            <template #content>
                <p>
                    Pēc konta dzēšanas visi tā resursi un dati tiks
                    neatgriezeniski dzēsti.
                </p>

                <div class="input-group">
                    <InputLabel
                        for="password"
                        value="Password"
                        class="sr-only"
                    />

                    <input
                        id="password"
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        class="password-input"
                        placeholder="Password"
                        @keyup.enter="deleteUser"
                    />

                    <InputError
                        :message="form.errors.password"
                        class="input-error"
                    />
                </div>
            </template>

            <template #side-content></template>

            <template #footer>
                <div class="modal-footer">
                    <button class="btn-secondary" @click="closeModal">
                        Atcelt
                    </button>

                    <button
                        class="btn-primary"
                        :disabled="form.processing"
                        @click="deleteUser"
                    >
                        Dzēst kontu
                    </button>
                </div>
            </template>
        </Modal>
    </section>
</template>

<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Modal from "@/Components/Modal.vue";
import { useForm } from "@inertiajs/vue3";
import { nextTick, ref } from "vue";

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: "",
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
    form.delete(route("profile.destroy"), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};
</script>

<style lang="scss" scoped>
#side-content {
    display: none;
    background-color: red;
}
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

.modal-content {
    padding: 1.5rem;
}

.modal-title {
    font-size: 1.125rem;
    font-weight: 500;
    color: var(--gray-900);
}

.modal-description {
    margin-top: 0.25rem;
    font-size: 0.875rem;
    color: var(--gray-600);
}

.input-group {
    margin-top: 1.5rem;
}

.modal-footer {
    display: flex;
    width: 100%;
    justify-content: space-between;
}

.password-input {
    display: block;
    width: 100%;
    margin-top: 0.25rem;
}

.input-error {
    margin-top: 0.5rem;
}

.button-group {
    display: flex;
    justify-content: flex-end;
    gap: 32px;
    margin-top: 1.5rem;
}
</style>
