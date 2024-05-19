<template>
    <Head title="Profils" />

    <AuthenticatedLayout>
        <template #header>
            <h1>Profils</h1>
        </template>

        <div class="content-container">
            <div class="form-container">
                <div class="form-wrapper">
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class="form-content"
                    />
                </div>

                <div class="form-wrapper">
                    <UpdatePasswordForm class="form-content" />
                </div>

                <div class="form-wrapper">
                    <DeleteUserForm class="form-content" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DeleteUserForm from "./Partials/DeleteUserForm.vue";
import UpdatePasswordForm from "./Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "./Partials/UpdateProfileInformationForm.vue";
import { Head } from "@inertiajs/vue3";

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<style lang="scss" scoped>
.content-container {
    padding: 3rem 0;
    display: flex;
    justify-content: center;
}

.form-container {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    max-width: 95rem;
    padding-inline: 0.5rem;
    width: 100%;

    .form-wrapper {
        padding: 1rem 2rem;
        background-color: #ffffff;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
            0 2px 4px -1px rgba(0, 0, 0, 0.06);
        border-radius: 0.5rem;

        width: 100%;
        .form-content {
            width: 100%;
        }
    }
}
</style>
