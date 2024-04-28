<template>
    <div
        v-if="isVisible"
        class="cart-sidebar"
        :class="{ visible: isSidebarVisible }"
    >
        <button @click="close" class="close-btn">
            <img src="@/Assets/xmark.svg" alt="remove icon" />
        </button>
        <h2>Jūsu Grozs</h2>
        <p>{{ cart }}</p>
        <div v-if="cartItems.length" class="cart-content">
            <ul class="cart-item-list">
                <li v-for="item in cartItems" :key="item.id" class="cart-item">
                    <img
                        :src="productImagePath(item.product.images[0])"
                        :alt="item.product.title"
                        class="cart-product-image"
                    />
                    {{ item.product.title }}
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
                    {{ itemTotalPrice(item) }}€
                    <button @click="removeItem(item.id)" class="delete-btn">
                        <img src="@/Assets/trash.svg" alt="delete-icon" />
                    </button>
                </li>
            </ul>
            <div class="bottom-box">
                <p>Kopā: {{ orderTotalPrice }}€</p>
                <PrimaryButton class="clear-cart">Pirkt</PrimaryButton>
                <SecondaryButton @click="clearCart" class="clear-cart"
                    >Notitīt Grozu</SecondaryButton
                >
            </div>
        </div>
        <div v-else>
            <p>Your cart is empty.</p>
        </div>
    </div>
</template>

<script>
import { nextTick } from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

export default {
    components: {
        PrimaryButton,
        SecondaryButton,
    },
    props: {
        cartItems: Array,
        cart: Array,
        isVisible: Boolean,
    },
    emits: ["close", "removeItem", "clearCart", "updateQuantity"],
    data() {
        return {
            isSidebarVisible: false,
        };
    },
    methods: {
        close() {
            this.$emit("close");
        },
        removeItem(id) {
            this.$emit("removeItem", id);
        },
        clearCart() {
            if (confirm("Are you sure you want to clear the cart?")) {
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
    box-shadow: -2px 0 8px rgba(0, 0, 0, 0.1);
    z-index: 100;
    padding: 20px;
    transform: translateX(100%);
    transition: transform 0.3s ease-in-out;
    overflow: auto;

    &.visible {
        transform: translateX(0);
    }

    h2 {
        margin-bottom: 1rem;
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

                .cart-product-image {
                    width: 50px;
                    height: auto;
                    margin-right: 10px;
                }

                .quantity-control {
                    display: flex;
                    align-items: center;

                    .quantity-btn {
                        width: 25px;
                        height: 25px;
                        background-color: var(--primary);
                        color: white;
                        border: none;
                        cursor: pointer;
                        border-radius: var(--border-rad);
                    }

                    .quantity-input {
                        width: 50px;
                        text-align: center;
                        margin: 0 5px;
                        border: 1px solid var(--primary);
                        border-radius: var(--border-rad);
                    }
                }
                .delete-btn {
                    background-color: var(--primary);

                    border-radius: var(--border-rad);
                    height: 1.5rem;
                    width: 1.5rem;
                    display: flex;
                    justify-content: center;
                    align-items: center;

                    img {
                        width: 100%;
                        padding: 4px;
                    }
                }
            }
        }

        .bottom-box {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            p {
                font-size: 25px;
            }
            .clear-cart {
                margin-top: auto;
                align-self: center;
            }
        }
    }
    .close-btn {
        display: flex;
        justify-content: flex-end;
        img {
            cursor: pointer;
            width: 25px;
            background-color: var(--primary);
            border-radius: 50%;
        }
    }
}
</style>
