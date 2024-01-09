<template>
    <Head title="Welcome" />

    <div class="page">
        <div v-if="canLogin" class="p-6 sm:fixed sm:top-0 sm:right-0 text-end">
            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                class="link"
                >Profile</Link
            >

            <template v-else>
                <Link :href="route('login')" class="link">Log in</Link>

                <Link v-if="canRegister" :href="route('register')" class="link"
                    >Register</Link
                >
            </template>
        </div>

        <div class="tools">
            Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
        </div>
    </div>
</template>

<script setup>
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<style lang="scss" scoped>
.page {
    position: relative;
    min-height: 100vh;
    background-color: #f3f4f6;
    background-position: center;

    .link {
        font-weight: 600;
        color: #4b5563;

        &:hover {
            color: #1f2937;
        }

        &:focus {
            outline: auto;
            outline-width: 2px;
            border-radius: 0.125rem;
            outline-color: #ef4444;
        }
    }
    .tools {
        font-size: 0.875rem;
        text-align: center;
        color: #6b7280;
        margin-left: 1rem;
    }
}

@media (min-width: 640px) {
    .page {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .tools {
        text-align: end;
        margin-left: 0;
    }
}
</style>
