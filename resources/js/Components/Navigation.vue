<template>
    <nav class="nav-container">
        <div class="top-navigation">
            <!-- Top Navigation Menu -->
            <div class="outer-container">
                <div class="inner-container">
                    <div class="social-container">
                        <a
                            class="icon"
                            href="https://instagram.com"
                            target="_blank"
                        >
                            <img src="../Assets/socials/instagram.svg" alt="" />
                        </a>
                        <a
                            class="icon"
                            href="https://tiktok.com"
                            target="_blank"
                        >
                            <img src="../Assets/socials/tiktok.svg" alt="" />
                        </a>
                        <a
                            class="icon"
                            href="https://facebook.com"
                            target="_blank"
                        >
                            <img src="../Assets/socials/facebook.svg" alt="" />
                        </a>
                    </div>

                    <div class="menu">
                        <!-- Settings Dropdown -->
                        <div class="dropdown-container">
                            <Dropdown align="right" width="48" class="">
                                <template #dropdown-label> test </template>
                                <template #link-container>
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
        </div>
        <div class="bot-navigation">
            <!-- Bottom Navigation Menu -->
            <div class="outer-container">
                <div class="inner-container">
                    <div class="flex" v-if="$page.props.auth.user">
                        <!-- Logo -->
                        <div class="logo-container">
                            <Link href="/dashboard">
                                <img
                                    src="@\Assets\Images\logo.svg"
                                    alt="website logo"
                                />
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
                            <NavLink
                                :href="route('products.index')"
                                :active="route().current('products.index')"
                            >
                                Produkti
                            </NavLink>
                            <NavLink
                                :href="route('users.index')"
                                :active="route().current('users.index')"
                            >
                                Lietotāji
                            </NavLink>
                        </div>
                    </div>
                    <div class="flex" v-else>
                        <div class="logo-container">
                            <Link href="/">
                                <img
                                    src="@\Assets\Images\logo.svg"
                                    alt="website logo"
                                />
                            </Link>
                        </div>

                        <div class="nav-link">
                            <NavLink
                                :href="route('home')"
                                :active="route().current('home')"
                            >
                                Sākums
                            </NavLink>

                            <NavLink
                                :href="route('printed')"
                                :active="route().current('printed')"
                            >
                                Printēts
                            </NavLink>
                            <NavLink
                                :href="route('original')"
                                :active="route().current('original')"
                            >
                                Oriģināls
                            </NavLink>
                            <NavLink
                                :href="route('woodwork')"
                                :active="route().current('woodwork')"
                            >
                                Kokdarbi
                            </NavLink>
                            <NavLink
                                :href="route('products-customer')"
                                :active="route().current('products-customer')"
                            >
                                Visi produkti
                            </NavLink>
                            <NavLink
                                :href="route('about')"
                                :active="route().current('about')"
                            >
                                Par Mani
                            </NavLink>
                        </div>
                    </div>

                    <div v-if="canLogin" class="account-menu">
                        <div v-if="$page.props.auth.user" class="account-links">
                            <div class="link-icon">
                                <Dropdown align="right" width="48" class="">
                                    <template #dropdown-label class="link">
                                        <button
                                            type="button"
                                            class="link"
                                        ></button>
                                        {{ $page.props.auth.user.name }}
                                    </template>
                                    <template #link-container>
                                        <DropdownLink
                                            :href="route('profile.edit')"
                                        >
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
                                <img
                                    src="../Assets/user.svg"
                                    alt="lietotajs"
                                    class="icon"
                                />
                            </div>
                            <div class="link-icon" @click="toggleCart($event)">
                                <p class="link"></p>
                                Grozs
                                <img
                                    src="../Assets/cart.svg"
                                    alt="raati"
                                    class="icon"
                                />
                            </div>
                        </div>

                        <div v-else class="account-links">
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
                            <div class="link-icon" @click="toggleCart($event)">
                                <p class="link">Grozs</p>

                                <img
                                    src="../Assets/cart.svg"
                                    alt="rati"
                                    class="icon"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <CartSidebar
            ref="cartSidebar"
            :cart-items="cartItems"
            :is-visible="isCartVisible"
            @close="toggleCart"
            @removeItem="handleRemoveItem"
            @clearCart="handleClearCart"
            @updateQuantity="updateQuantity"
        />
    </nav>
</template>

<script>
import ApplicationLogo from "./ApplicationLogo.vue";
import Dropdown from "./Dropdown.vue";
import DropdownLink from "./DropdownLink.vue";
import NavLink from "./NavLink.vue";
import { Link } from "@inertiajs/vue3";
import CartSidebar from "@/Pages/User/CartSidebar.vue";

export default {
    components: {
        CartSidebar,
        ApplicationLogo,
        Dropdown,
        DropdownLink,
        NavLink,
        Link,
    },
    props: {
        canLogin: {
            type: Boolean,
            default: true,
        },
        canRegister: {
            type: Boolean,
            default: false,
        },
    },
    data() {
        return {
            isCartVisible: false,
            cartItems: [],
        };
    },
    methods: {
        toggleCart(event) {
            if (event) {
                event.stopPropagation();
            }

            this.isCartVisible = !this.isCartVisible;

            if (this.isCartVisible) {
                document.addEventListener(
                    "click",
                    this.handleClickOutside,
                    true
                );
                this.fetchCartItems();
            } else {
                document.removeEventListener(
                    "click",
                    this.handleClickOutside,
                    true
                );
            }

            this.lockBodyScroll(this.isCartVisible);
        },
        handleClickOutside(event) {
            if (
                this.$refs.cartSidebar &&
                !this.$refs.cartSidebar.$el.contains(event.target)
            ) {
                this.toggleCart();
            }
        },
        fetchCartItems() {
            axios
                .get("/cart")
                .then((response) => {
                    this.cartItems = response.data.cartItems;
                })
                .catch((error) => {
                    console.error("Error fetching cart items:", error);
                });
        },

        handleRemoveItem(id) {
            axios
                .delete(`/cart/${id}`)
                .then((response) => {
                    this.fetchCartItems();
                })
                .catch((error) => {
                    console.error("Error removing item from cart:", error);
                });
        },
        handleClearCart() {
            axios
                .post("/cart/clear")
                .then((response) => {
                    this.cartItems = [];
                })
                .catch((error) => {
                    console.error("Error clearing the cart:", error);
                });
        },
        updateQuantity(item, newQuantity) {
            axios
                .patch(`/cart/item/${item.id}`, { quantity: newQuantity })
                .then((response) => {
                    this.fetchCartItems(); // Refresh cart items to reflect the updated quantity
                })
                .catch((error) => {
                    console.error("Error updating item quantity:", error);
                });
        },
        lockBodyScroll(lock) {
            document.body.style.overflow = lock ? "hidden" : "";
        },
    },
    watch: {
        isCartVisible(newValue) {
            this.lockBodyScroll(newValue);
        },
    },
    beforeUnmount() {
        document.removeEventListener("click", this.handleClickOutside);
    },
};
</script>

<style lang="scss" scoped>
.link {
    display: inline-flex;
    align-items: center;
    font-size: 0.875rem;
    font-weight: 300;
    line-height: 1.25;
    color: var(--primary);
    cursor: pointer;
}
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
                gap: 0.5rem;
                a {
                    width: 1.2rem;
                    aspect-ratio: 1 / 1;

                    img {
                        height: 100%;
                    }
                }
            }

            .menu {
                display: flex;

                @media (min-width: 768px) {
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
                img {
                    display: block;
                    width: auto;
                    color: var(--primary);
                    fill: currentColor;
                    height: 3rem;
                }
            }
            .account-menu {
                display: flex;
                align-items: center;
                flex-direction: row;
                gap: 1rem;

                @media (max-width: 640px) {
                    display: none;
                }

                .account-links {
                    display: flex;
                    flex-direction: row;
                    gap: 1rem;
                    .link-icon {
                        display: flex;
                        flex-direction: row;

                        .icon {
                            aspect-ratio: 1 / 1;
                            height: 1rem;
                        }
                    }
                }
            }
        }
    }
}
</style>
