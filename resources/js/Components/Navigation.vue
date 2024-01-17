<template>
    <nav class="nav-container">
        <div class="top-navigation">
            <!-- Top Navigation Menu -->
            <div class="outer-container">
                <div class="inner-container">
                    <div class="social-container"></div>

                    <div class="menu">
                        <!-- Settings Dropdown -->
                        <div class="dropdown-container">
                            <Dropdown align="right" width="48" class="">
                            </Dropdown>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bot-navigation">
            <!-- Bottom Navigation Menu -->
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
                                :href="route('home')"
                                :active="route().current('home')"
                            >
                                Sākums
                            </NavLink>
                            <NavLink
                                :href="route('dashboard')"
                                :active="route().current('dashboard')"
                            >
                                Panelis
                            </NavLink>
                        </div>
                    </div>

                    <div v-if="canLogin" class="account-menu">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('dashboard')"
                            class="link"
                            >{{ $page.props.auth.user.name }}</Link
                        >

                        <template v-else>
                            <Link :href="route('login')" class="link"
                                >Pieslēgties</Link
                            >
                            <Link :href="route('login')" class="link"
                                >Grozs</Link
                            >
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>

<script setup>
import ApplicationLogo from "./ApplicationLogo.vue";
import Dropdown from "./Dropdown.vue";

import NavLink from "./NavLink.vue";
import { Link } from "@inertiajs/vue3";

defineProps({
    canLogin: {
        type: Boolean,
        default: true,
    },
    canRegister: {
        type: Boolean,
        default: false,
    },
});
</script>

<style lang="scss" scoped>
.inner-container {
    display: flex;
    justify-content: space-between;
    height: 2rem;
}
.nav-container {
    border-bottom: 1px solid #f3f4f6;
    width: 100%;
    .top-navigation {
        background-color: var(--primary);
        width: 100%;

        .outer-container {
            padding: 0 1rem;
            margin: 0 auto;
            max-width: 80rem;

            @media (min-width: 640px) {
                padding: 0 1.5rem;
            }

            @media (min-width: 1024px) {
                padding: 0 2rem;
            }

            .social-container {
                display: flex;
            }

            .menu {
                display: none;

                @media (min-width: 640px) {
                    display: flex;
                    align-items: center;
                    margin-left: 1.5rem;
                }

                .dropdown-container {
                    position: relative;
                    margin-left: 0.75rem;
                }
            }
        }
    }
    .bot-navigation {
        background-color: var(--secondary);
        width: 100%;
        .nav-link {
            display: none;
            @media (min-width: 640px) {
                display: flex;
                gap: 1rem;
                margin-top: -1px;
                margin-bottom: -1px;
                margin-inline-start: 2.5rem;
            }
        }
        .logo-container {
            display: flex;
            align-items: center;
            flex-shrink: 0;
            gap: 1rem;
            .logo {
                display: block;
                width: auto;
                color: var(--neutral-two);
                fill: currentColor;
                height: 2.25rem;
            }
        }
        .account-menu {
            display: flex;
            align-items: center;
            gap: 1rem;

            @media (max-width: 640px) {
                display: none;
            }
            .link {
                display: inline-flex;
                align-items: center;
                font-size: 0.875rem;
                font-weight: 500;
                line-height: 1.25;
                color: var(--neutral-two);
            }
        }
    }
}
</style>
