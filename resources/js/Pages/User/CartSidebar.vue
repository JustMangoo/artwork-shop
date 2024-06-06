<template>
    <div
        v-if="isVisible"
        class="cart-sidebar"
        :class="{ visible: isSidebarVisible }"
    >
        <div class="cart-heading">
            <h3>Grozs</h3>
            <button @click="close" class="close-btn">
                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M6 6L18 18M18 6L6 18"
                        stroke-width="2"
                        stroke-linecap="sharp"
                        stroke-linejoin="sharp"
                    />
                </svg>
            </button>
        </div>

        <div v-if="cartItems.length" class="cart-content">
            <ul class="cart-item-list">
                <li v-for="item in cartItems" :key="item.id" class="cart-item">
                    <img
                        :src="productImagePath(item.product.images[0])"
                        :alt="item.product.title"
                        class="cart-product-image"
                    />
                    <div class="cart-item-info">
                        <p>{{ item.product.title }}</p>
                        <p>{{ itemTotalPrice(item) }}€</p>
                        <div class="quantity-control">
                            <button
                                @click="decreaseQuantity(item)"
                                class="quantity-btn"
                            >
                                -
                            </button>
                            <input
                                type="text"
                                v-model="item.quantity"
                                class="quantity-input"
                                readonly
                            />
                            <button
                                @click="increaseQuantity(item)"
                                class="quantity-btn"
                            >
                                +
                            </button>
                        </div>
                    </div>

                    <button @click="removeItem(item.id)" class="delete-btn">
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6M18 6V16.2C18 17.8802 18 18.7202 17.673 19.362C17.3854 19.9265 16.9265 20.3854 16.362 20.673C15.7202 21 14.8802 21 13.2 21H10.8C9.11984 21 8.27976 21 7.63803 20.673C7.07354 20.3854 6.6146 19.9265 6.32698 19.362C6 18.7202 6 17.8802 6 16.2V6M14 10V17M10 10V17"
                                stroke-width="2"
                                stroke-linecap="sharp"
                                stroke-linejoin="sharp"
                            />
                        </svg>
                    </button>
                </li>
            </ul>
            <div class="bottom-box">
                <p>Kopā: {{ orderTotalPrice }}€</p>
                <button class="w-full btn-primary" @click="checkout">
                    Pirkt
                </button>
                <button class="w-full btn-secondary" @click="clearCart">
                    Notīrīt Grozu
                </button>
            </div>
        </div>
        <div v-else>
            <p>Your cart is empty.</p>
        </div>
    </div>
</template>

<script>
import { useForm } from "@inertiajs/vue3";
import { nextTick } from "vue";

export default {
    components: {},
    props: {
        cartItems: Array,
        cart: Array,
        isVisible: Boolean,
    },
    emits: ["close", "removeItem", "clearCart", "updateQuantity"],
    data() {
        return {
            isSidebarVisible: false,
            form: useForm({
                cartItems: [],
            }),
        };
    },
    methods: {
        checkout() {
            axios
                .post(route("checkout"), { cartItems: this.cartItems })
                .then((response) => {
                    // Redirect to Stripe checkout page
                    window.location.href = response.data.url;
                })
                .catch((error) => {
                    console.error("Checkout error:", error.response.data);
                });
        },

        close() {
            this.$emit("close");
        },
        removeItem(id) {
            this.$emit("removeItem", id);
        },
        clearCart() {
            if (confirm("Vai esat pārliecināts, ka vēlaties notīrīt grozu?")) {
                this.$emit("clearCart");
            }
        },

        increaseQuantity(item) {
            if (item.quantity < 5) {
                const newQuantity = item.quantity + 1;
                item.quantity = newQuantity;
                this.$emit("updateQuantity", item, newQuantity);
            }
        },
        decreaseQuantity(item) {
            if (item.quantity > 1) {
                const newQuantity = item.quantity - 1;
                item.quantity = newQuantity;
                this.$emit("updateQuantity", item, newQuantity);
            }
        },
        productImagePath(image) {
            const imagePath = image.image
                ? "/storage/" + image.image.replace("public/", "")
                : "resources/js/Assets/Images/Image1.png";
            return imagePath;
        },
        itemTotalPrice(item) {
            return (item.quantity * item.product.price).toFixed(2);
        },
    },
    computed: {
        orderTotalPrice() {
            return this.cartItems
                .reduce((total, item) => {
                    return total + item.quantity * item.product.price;
                }, 0)
                .toFixed(2);
        },
    },
    watch: {
        isVisible(newVal) {
            if (newVal) {
                nextTick(() => {
                    setTimeout(() => {
                        this.isSidebarVisible = true;
                    }, 1);
                });
            } else {
                this.isSidebarVisible = false;
            }
        },
    },
};
</script>

<style lang="scss" scoped>
.cart-sidebar {
    position: fixed;
    right: 0;
    top: 0;
    display: flex;
    flex-direction: column;
    width: 400px;
    height: 100vh;
    background: white;
    box-shadow: -2px 0 100px rgba(0, 0, 0, 0.1);
    z-index: 100;
    transform: translateX(100%);
    transition: transform 0.3s ease-in-out;
    overflow: auto;
    gap: 32px;

    &.visible {
        transform: translateX(0);
    }

    h2 {
        margin-bottom: 1rem;
    }

    .cart-heading {
        display: flex;
        justify-content: space-between;
        padding: 20px;
    }

    .cart-content {
        display: flex;
        flex-direction: column;
        flex-grow: 1;
        justify-content: space-between;

        .cart-item-list {
            .cart-item {
                display: flex;
                justify-content: space-between;
                align-items: center;
                height: fit-content;
                width: 100%;
                overflow-y: auto;
                flex-grow: 1;
                background-color: var(--color--secondary);
                padding: 20px;

                .cart-product-image {
                    width: 50px;
                    height: auto;
                    margin-right: 10px;
                }

                .cart-item-info {
                    display: flex;
                    flex-direction: column;
                    .quantity-control {
                        display: flex;
                        align-items: center;
                        border: 1px solid var(--color--primary);
                        border-radius: var(--rounded-elem);
                        background-color: var(--color--white);
                        width: fit-content;
                        button {
                            width: 25px;
                            height: 25px;
                            padding: 0;
                            background-color: transparent;
                            color: var(--color--primary);
                            border: none;
                            cursor: pointer;
                            font-weight: 500;
                            font-size: 1.5rem;

                            &:hover {
                                scale: 1;
                            }
                        }
                        input {
                            font-size: 1.2rem;
                            padding: 8px 0;
                            width: 30px;
                            text-align: center;
                            margin: 0;
                            border: none;
                            outline: none;
                        }
                    }
                }

                .delete-btn {
                    background-color: transparent;
                    height: 1.5rem;
                    aspect-ratio: 1/1;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    padding: 0;
                    margin: 0;

                    svg {
                        cursor: pointer;
                        width: 30px;
                        aspect-ratio: 1/1;
                        stroke: var(--color--primary);
                    }
                }
            }
        }

        .bottom-box {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            padding: 20px;
            p {
                font-size: 25px;
            }
        }
    }
    .close-btn {
        padding: 0;
        background-color: transparent;

        svg {
            cursor: pointer;
            width: 30px;
            aspect-ratio: 1/1;
            stroke: var(--color--primary);
        }
    }
}
</style>
