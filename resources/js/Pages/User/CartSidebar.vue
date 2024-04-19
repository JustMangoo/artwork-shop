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
                    {{ item.product.title }} - {{ item.quantity }}
                    <button @click="removeItem(item.id)" class="delete-btn">
                        <img src="@/Assets/trash.svg" alt="delete-icon" />
                    </button>
                </li>
            </ul>
            <PrimaryButton @click="clearCart" class="clear-cart"
                >Clear Cart</PrimaryButton
            >
        </div>
        <div v-else>
            <p>Your cart is empty.</p>
        </div>
    </div>
</template>

<script>
import { nextTick } from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

export default {
    components: {
        PrimaryButton,
    },
    props: {
        cartItems: Array,
        cart: Array,
        isVisible: Boolean,
    },
    emits: ["close", "removeItem", "clearCart"],
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
            this.$emit("clearCart");
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

    &.visible {
        transform: translateX(0);
    }

    h2 {
        margin-bottom: 1rem;
    }

    .cart-content {
        display: flex;
        flex-direction: column;

        .cart-item-list {
            .cart-item {
                display: flex;
                justify-content: space-between;
                align-items: center;
                height: fit-content;
                width: 100%;
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

        .clear-cart {
            background-color: var(--primary);
            border-radius: var(--border-rad);
        }
    }
    .close-btn {
        display: flex;
        justify-content: end;
        img {
            cursor: pointer;
            width: 25px;
            background-color: var(--primary);
            border-radius: 50%;
        }
    }
}
</style>
