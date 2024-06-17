<template>
    <nav class="nav-container">
        <div class="outer-container">
            <div class="inner-container">
                <div
                    class="wrapper--logo-links"
                    v-if="
                        $page.props.auth.user &&
                        ($page.props.auth.user.role_id === 2 ||
                            $page.props.auth.user.role_id === 3)
                    "
                >
                    <!-- Logo -->
                    <div class="logo-container">
                        <Link href="/dashboard">
                            <img
                                src="@\Assets\Images\logo.svg"
                                alt="website logo"
                            />
                        </Link>
                    </div>

                    <div class="line-seperator"></div>

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
                            :href="route('orders.index')"
                            :active="route().current('orders.index')"
                        >
                            Pasūtījumi
                        </NavLink>
                        <NavLink
                            :href="route('users.index')"
                            :active="route().current('users.index')"
                            v-if="$page.props.auth.user.role_id === 2"
                        >
                            Lietotāji
                        </NavLink>
                    </div>
                </div>
                <div class="wrapper--logo-links" v-else>
                    <div class="logo-container">
                        <Link href="/">
                            <img
                                src="@\Assets\Images\logo.svg"
                                alt="website logo"
                            />
                        </Link>
                    </div>

                    <div class="line-seperator"></div>

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
                    <div class="account-links">
                        <div class="link-icon">
                            <Dropdown v-if="$page.props.auth.user">
                                <template #dropdown-label>
                                    <svg
                                        width="24px"
                                        height="24px"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        class="icon"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"
                                            stroke-width="1.5"
                                            stroke-linecap="sharp"
                                            stroke-linejoin="sharp"
                                        />
                                        <path
                                            d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z"
                                            stroke-width="1.5"
                                            stroke-linecap="sharp"
                                            stroke-linejoin="sharp"
                                        />
                                    </svg>
                                </template>
                                <template #link-container>
                                    <DropdownLink
                                        v-if="route('profile.edit')"
                                        :href="route('profile.edit')"
                                    >
                                        Profils
                                    </DropdownLink>
                                    <DropdownLink
                                        v-if="
                                            route('customer.orders') &&
                                            $page.props.auth.user.role_id === 1
                                        "
                                        :href="route('customer.orders')"
                                    >
                                        Pasūtījumi
                                    </DropdownLink>
                                    <DropdownLink
                                        :href="route('logout')"
                                        method="post"
                                    >
                                        Iziet
                                    </DropdownLink>
                                </template>
                            </Dropdown>
                            <Link v-else :href="route('login')" class="link">
                                <svg
                                    width="24px"
                                    height="24px"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    class="icon"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"
                                        stroke-width="1.5"
                                        stroke-linecap="sharp"
                                        stroke-linejoin="sharp"
                                    />
                                    <path
                                        d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z"
                                        stroke-width="1.5"
                                        stroke-linecap="sharp"
                                        stroke-linejoin="sharp"
                                    />
                                </svg>
                            </Link>
                        </div>
                        <div
                            v-if="
                                !$page.props.auth.user ||
                                $page.props.auth.user.role_id === 1
                            "
                            class="link-icon"
                            @click="toggleCart($event)"
                        >
                            <svg
                                width="24px"
                                height="24px"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                                class="icon"
                            >
                                <path
                                    d="M6.29977 5H21L19 12H7.37671M20 16H8L6 3H3M9 20C9 20.5523 8.55228 21 8 21C7.44772 21 7 20.5523 7 20C7 19.4477 7.44772 19 8 19C8.55228 19 9 19.4477 9 20ZM20 20C20 20.5523 19.5523 21 19 21C18.4477 21 18 20.5523 18 20C18 19.4477 18.4477 19 19 19C19.5523 19 20 19.4477 20 20Z"
                                    stroke-width="1.5"
                                    stroke-linecap="sharp"
                                    stroke-linejoin="sharp"
                                />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div
            v-if="
                $page.props.flash.success ||
                $page.props.flash.error ||
                $page.props.flash.warning ||
                $page.props.flash.message
            "
        >
            <SystemAlert
                v-if="!flashMessage !== null"
                :message="getMessageText()"
                :type="getMessageType()"
                :uniqueKey="getMessageKey()"
            />
        </div>

        <CartSidebar
            ref="cartSidebar"
            :cart-items="cartItems"
            :is-visible="isCartTrue"
            @close="toggleCart"
            @removeItem="handleRemoveItem"
            @clearCart="promptClearCart"
            @updateQuantity="updateQuantity"
        />
        <Modal
            v-if="showModal"
            @close="showModal = false"
            @save="handleClearCart"
        >
            <template #header>
                <h2>Apstiprināt darbību</h2>
            </template>
            <template #content>
                <p>Vai esat pārliecināts, ka vēlaties atbrīvot grozu?</p>
            </template>
            <template #footer>
                <div class="modal-footer">
                    <button class="btn-secondary" @click="showModal = false">
                        Atcelt
                    </button>
                    <button class="btn-primary" @click="handleClearCart">
                        Notīrīt grozu
                    </button>
                </div>
            </template>
        </Modal>
    </nav>
</template>

<script>
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import SystemAlert from "@/Components/SystemAlert.vue";
import Modal from "@/Components/Modal.vue";
import { Link } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";

import CartSidebar from "@/Pages/User/CartSidebar.vue";

export default {
    components: {
        CartSidebar,
        Dropdown,
        DropdownLink,
        NavLink,
        Link,
        SystemAlert,
        Modal,
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
            isCartTrue: false,
            isCartVisible: false,
            cartItems: this.fetchCartItems(),
            flashMessage: null,
            flashType: null,
            showModal: false,
        };
    },
    mounted() {
        this.checkFlashMessages();
    },
    methods: {
        getMessageType() {
            if (this.$page.props.flash.success) return "success";
            else if (this.$page.props.flash.error) return "error";
            else if (this.$page.props.flash.warning) return "warning";
            else return "message";
        },
        getMessageText() {
            if (this.$page.props.flash.success)
                return this.$page.props.flash.success.message;
            else if (this.$page.props.flash.error)
                return this.$page.props.flash.error.message;
            else if (this.$page.props.flash.warning)
                return this.$page.props.flash.warning.message;
            else return this.$page.props.flash.message.message;
        },
        getMessageKey() {
            if (this.$page.props.flash.success)
                return this.$page.props.flash.success.uniqueKey;
            else if (this.$page.props.flash.error)
                return this.$page.props.flash.error.uniqueKey;
            else if (this.$page.props.flash.warning)
                return this.$page.props.flash.warning.uniqueKey;
            else return this.$page.props.flash.message.uniqueKey;
        },
        toggleCart(event) {
            if (event) {
                event.stopPropagation();
            }
            this.clearFlashMessages;
            this.isCartTrue = !this.isCartTrue;
            this.isCartVisible = !this.isCartVisible;

            if (this.isCartTrue) {
                document.addEventListener(
                    "click",
                    this.handleClickOutside,
                    true
                );

                this.fetchCartItems();
                this.isCartVisible = true;
            } else {
                this.isCartVisible = false;
                document.removeEventListener(
                    "click",
                    this.handleClickOutside,
                    true
                );
            }

            this.lockBodyScroll(this.isCartVisible);
        },
        checkFlashMessages() {
            const flash = this.$page.props.flash;
            if (flash.success) {
                this.flashMessage = flash.success.message;
            } else if (flash.error) {
                this.flashMessage = flash.error.message;
            } else if (flash.warning) {
                this.flashMessage = flash.warning.message;
            } else if (flash.message) {
                this.flashMessage = flash.message.message;
            }
        },
        clearFlashMessages() {
            this.flashMessage = null;
            this.flashType = null;
        },
        showMessage(message, type) {
            console.log(message, type);
        },
        // Apstrādā klikšķi ārpus groza sānjoslas, lai to aizvērtu
        handleClickOutside(event) {
            if (
                this.$refs.cartSidebar &&
                !this.$refs.cartSidebar.$el.contains(event.target)
            ) {
                this.toggleCart();
            }
        },
        // Iegūst groza preces no servera
        fetchCartItems() {
            if (!this.isLoggedIn()) {
                this.cartItems =
                    JSON.parse(localStorage.getItem("cartItems")) || [];
            } else {
                // Fetch from server
                axios
                    .get("/cart")
                    .then((response) => {
                        this.cartItems = response.data.cartItems;
                    })
                    .catch((error) => {
                        console.error("Error fetching cart items:", error);
                    });
            }
        },
        // Apstrādā preces noņemšanu no groza
        handleRemoveItem(id) {
            if (!this.isLoggedIn()) {
                this.cartItems = this.cartItems.filter(
                    (item) => item.id !== id
                );
                localStorage.setItem(
                    "cartItems",
                    JSON.stringify(this.cartItems)
                );
            } else {
                this.$inertia.delete(`/cart/${id}`, {
                    onSuccess: () => {
                        this.fetchCartItems();
                    },
                });
            }
        },
        // Atjaunina preces daudzumu grozā
        updateQuantity(item, newQuantity) {
            if (!this.isLoggedIn()) {
                const itemIndex = this.cartItems.findIndex(
                    (cartItem) => cartItem.id === item.id
                );
                if (itemIndex !== -1) {
                    this.cartItems[itemIndex].quantity = newQuantity;
                    localStorage.setItem(
                        "cartItems",
                        JSON.stringify(this.cartItems)
                    );
                }
            } else {
                this.$inertia.patch(
                    `/cart/item/${item.id}`,
                    { quantity: newQuantity },
                    {
                        onSuccess: () => {
                            this.fetchCartItems();
                        },
                    }
                );
            }
        },
        // Apstrādā visa groza notīrīšanu
        promptClearCart() {
            this.showModal = true;
        },
        handleClearCart() {
            if (!this.isLoggedIn()) {
                this.cartItems = [];
                localStorage.setItem(
                    "cartItems",
                    JSON.stringify(this.cartItems)
                );
                this.showModal = false;
            } else {
                this.$inertia.post(
                    "/cart/clear",
                    {},
                    {
                        onSuccess: () => {
                            this.cartItems = [];
                            this.showModal = false;
                        },
                    }
                );
            }
        },

        lockBodyScroll(lock) {
            document.body.style.overflow = lock ? "hidden" : "";
        },
        isLoggedIn() {
            return this.$page.props.auth.user !== null;
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
.nav-container {
    background-color: var(--color--white);
    width: 100%;
    position: sticky;
    top: 0;
    z-index: 100;
    .modal-footer {
        display: flex;
        width: 100%;
        justify-content: space-between;
    }

    .outer-container {
        margin: 0 auto;
        max-width: 95rem;
        padding-inline: 0.5rem;

        .inner-container {
            height: 96px;
            display: flex;
            justify-content: space-between;

            .wrapper--logo-links {
                display: flex;
                align-items: center;
                gap: 2rem;

                .logo-container {
                    display: flex;
                    align-items: center;
                    flex-shrink: 0;

                    img {
                        display: block;
                        width: auto;
                        height: 3rem;
                        color: var(--color--primary);
                        fill: currentColor;
                    }
                }
                .line-seperator {
                    height: 70%;
                    width: 1px;
                    background-color: var(--color--secondary);
                }

                .nav-link {
                    display: none;

                    @media (min-width: 640px) {
                        display: flex;
                        gap: 1rem;
                        margin-top: -1px;
                        margin-bottom: -1px;
                        height: 100%;
                    }
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
                            height: 24px;
                            stroke: var(--color--dark);
                            cursor: pointer;
                        }
                    }
                }
            }
        }
    }
}

.link {
    display: inline-flex;
    align-items: center;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1.25;
    letter-spacing: normal;
    color: var(--color--dark);
    cursor: pointer;
    text-transform: capitalize;
}
</style>
