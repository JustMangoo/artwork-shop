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
            <div class="outer-container">
                <div class="inner-container">
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
                                :href="route('products.index')"
                                :active="route().current('products.index')"
                            >
                                Produkti
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
                            <div class="link-icon">
                                <Link :href="route('login')" class="link"
                                    >Pieslēgties</Link
                                >
                                <img
                                    src="../Assets/user.svg"
                                    alt="lietotajs"
                                    class="icon"
                                />
                            </div>
                            <div class="link-icon">
                                <Link :href="route('login')" class="link"
                                    >Grozs</Link
                                >
                                <img
                                    src="../Assets/cart.svg"
                                    alt="rati"
                                    class="icon"
                                />
                            </div>
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

.outer-container {
    margin: 0 auto;
    max-width: 95rem;
    padding-inline: 0.5rem;
}
.nav-container {
    border-bottom: 1px solid #f3f4f6;
    width: 100%;
    .top-navigation {
        background-color: var(--primary);
        width: 100%;

        .outer-container {
            .social-container {
                display: flex;
            }

            .menu {
                display: flex;

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
        .inner-container {
            height: 4rem;

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
                .link-icon {
                    display: flex;
                    flex-direction: row;
                    .link {
                        display: inline-flex;
                        align-items: center;
                        font-size: 0.875rem;
                        font-weight: 500;
                        line-height: 1.25;
                        color: var(--neutral-two);
                    }
                    .icon {
                        aspect-ratio: 1 / 1;
                        width: 1rem;
                    }
                }
            }
        }
    }
}
</style>
