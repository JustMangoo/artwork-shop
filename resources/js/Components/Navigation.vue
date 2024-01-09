<template>
    <nav class="navigation">
        <!-- Primary Navigation Menu -->
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="logo-container">
                        <Link href="/">
                            <ApplicationLogo class="logo" />
                        </Link>
                    </div>

                    <!-- Navigation Links -->
                    <div class="nav-link">
                        <NavLink
                            :href="route('dashboard')"
                            :active="route().current('dashboard')"
                        >
                            Panelis
                        </NavLink>
                    </div>
                </div>

                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <!-- Settings Dropdown -->
                    <div class="relative ms-3">
                        <Dropdown align="right" width="48">
                            <template #trigger>
                                <span class="inline-flex rounded-md">
                                    <button
                                        type="button"
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-transparent border border-transparent rounded-md hover:text-gray-700 focus:outline-none"
                                    >
                                        <!-- {{ $page.props.auth.user.name }} -->
                                        LV
                                        <svg
                                            class="ms-2 -me-0.5 h-4 w-4"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </button>
                                </span>
                            </template>

                            <template #content>
                                <DropdownLink :href="route('profile.edit')">
                                    Profils
                                </DropdownLink>
                                <DropdownLink
                                    :href="route('logout')"
                                    method="post"
                                    as="button"
                                >
                                    Iziet
                                </DropdownLink>
                            </template>
                        </Dropdown>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>

<script setup>
import ApplicationLogo from "./ApplicationLogo.vue";
import Dropdown from "./Dropdown.vue";
import DropdownLink from "./DropdownLink.vue";
import NavLink from "./NavLink.vue";
import { Link } from "@inertiajs/vue3";
</script>

<style lang="scss" scoped>
.navigation {
    background-color: var(--secondary);
    border-bottom: 1px solid #f3f4f6;
    .nav-link {
        display: none;
        @media (min-width: 640px) {
            display: flex;
            margin-top: -1px;
            margin-bottom: -1px;
            margin-inline-start: 2.5rem;
        }
    }
    .logo-container {
        display: flex;
        align-items: center;
        flex-shrink: 0;
        .logo {
            display: block;
            width: auto;
            color: var(--neutral-two);
            fill: currentColor;
            height: 2.25rem;
        }
    }
}
</style>
