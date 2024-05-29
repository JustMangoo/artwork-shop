<template>
    <MainLayout>
        <div class="orders-container">
            <h1 class="orders-title">Mani Pasūtījumi</h1>

            <div
                v-for="(groupedOrders, monthYear) in groupedByMonth"
                :key="monthYear"
                class="order-month-block"
            >
                <h2>{{ monthYear }}</h2>
                <div
                    v-for="order in groupedOrders"
                    :key="order.id"
                    class="order-card"
                >
                    <div class="order-images">
                        <!-- Display up to four product images or placeholders -->
                        <div v-for="n in 4" :key="n" class="product-image">
                            <img
                                v-if="order.items[n - 1]"
                                :src="
                                    productImagePath(
                                        order.items[n - 1].product.images[0]
                                            ?.image
                                    )
                                "
                                alt="Product Image"
                            />
                            <div
                                v-if="!order.items[n - 1]"
                                class="placeholder-image"
                            ></div>
                        </div>
                    </div>
                    <div class="order-info">
                        <div>
                            <strong>Pasūtījuma nr.:</strong>
                            <p>{{ order.id }}</p>
                        </div>
                        <div>
                            <strong>Statuss:</strong>
                            <p>{{ order.status }}</p>
                        </div>
                        <div>
                            <strong>Cena:</strong>
                            <p>{{ order.total_price }} €</p>
                        </div>
                        <button
                            class="view-details-btn"
                            @click="showOrderDetails(order)"
                        >
                            Skatīt
                        </button>
                    </div>
                </div>
            </div>
            <div v-if="orders.length === 0" class="no-orders">
                <p>Nav atrasti pasūtījumi.</p>
            </div>
            <Modal v-if="isModalOpen" @close="closeModal" :showSidebar="true">
                <template #header>
                    <h2>#{{ selectedOrder.id }} Pasūtījums</h2>
                </template>
                <template #content class="modal-content">
                    <div class="order-items-container">
                        <h3>
                            Pasūtījuma preces ({{ selectedOrder.items.length }})
                        </h3>
                        <div
                            v-for="item in selectedOrder.items"
                            :key="item.id"
                            class="order-item"
                        >
                            <div class="product-image">
                                <img
                                    :src="
                                        productImagePath(
                                            item.product.images[0].image
                                        )
                                    "
                                    alt="Product Image"
                                />
                            </div>
                            <div class="product-details">
                                <p class="product-title">
                                    {{ item.product.title }}
                                </p>
                                <p>
                                    {{ item.product.price }}€ Par Vienību x
                                    {{ item.quantity }} Daudzums
                                </p>
                            </div>
                            <div class="product-summary">
                                <h3>
                                    {{
                                        calculateGrandTotal(
                                            item.product.price,
                                            item.quantity
                                        )
                                    }}€
                                </h3>
                                <p>Price - {{ item.product.price }}€</p>
                                <p>Tax - 0.00€</p>
                                <p>
                                    Sub Total -
                                    {{
                                        calculateSubTotal(
                                            item.product.price,
                                            item.quantity
                                        )
                                    }}€
                                </p>
                            </div>
                        </div>
                        <div class="order-summary">
                            <div class="order-summary-label">
                                <strong>Starpsumma</strong>
                                <p>Nodokļi</p>
                                <p>Piegāde</p>
                                <strong>Kopsumma</strong>
                                <p>Kopā samaksāts</p>
                                <p>Kopā atgriezts</p>
                                <p>Kopējais maksājums</p>
                            </div>
                            <div class="order-summary-values">
                                <strong
                                    >€{{ selectedOrder.total_price }}</strong
                                >
                                <p>€0.00</p>
                                <p>€0.00</p>
                                <strong
                                    >€{{ selectedOrder.total_price }}</strong
                                >
                                <p>€{{ selectedOrder.total_price }}</p>
                                <p>€0.00</p>
                                <p>€{{ selectedOrder.total_price }}</p>
                            </div>
                        </div>
                    </div>
                </template>
                <template #side-content>
                    <h3>Klients</h3>
                    <p>
                        <strong>{{ selectedOrder.full_name }}</strong>
                    </p>
                    <p>{{ selectedOrder.email }}</p>
                    <p>{{ selectedOrder.phone_number }}</p>
                    <h3>Piegādes adrese:</h3>
                    <p>
                        {{ selectedOrder.shipping_country }}
                        {{ selectedOrder.shipping_address }},
                        {{ selectedOrder.shipping_city }},
                        {{ selectedOrder.shipping_postal_code }}
                    </p>
                    <h3>Pasūtījuma info</h3>
                    <p>
                        <strong>Sessijas ID:</strong>
                        {{ selectedOrder.session_id }}
                    </p>
                    <p>
                        <strong>Pasūtījuma datums:</strong>
                        {{ formatDateNumeral(selectedOrder.created_at) }}
                    </p>
                    <p>
                        <strong>Statuss:</strong>
                        {{ selectedOrder.status }}
                    </p>
                </template>
                <template #footer>
                    <button @click="closeModal">Aizvērt</button>
                </template>
            </Modal>
        </div>
    </MainLayout>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import Modal from "@/Components/Modal.vue";

export default {
    components: {
        MainLayout,
        Modal,
    },
    props: {
        orders: Array,
    },
    data() {
        return {
            isModalOpen: false,
            selectedOrder: {},
        };
    },
    computed: {
        groupedByMonth() {
            const groups = {};
            this.orders.forEach((order) => {
                const monthYear = this.formatDate(order.created_at);
                if (!groups[monthYear]) {
                    groups[monthYear] = [];
                }
                groups[monthYear].push(order);
            });
            return groups;
        },
    },
    methods: {
        formatDate(value) {
            if (!value) return "";
            const date = new Date(value);
            return (
                date.toLocaleDateString("lv-LV", {
                    month: "long",
                }) +
                ", " +
                date.getFullYear()
            ); // Adding ', ' to match the desired format
        },
        formatDateNumeral(dateString) {
            const date = new Date(dateString);
            const day = date.getDate().toString().padStart(2, "0");
            const month = (date.getMonth() + 1).toString().padStart(2, "0");
            const year = date.getFullYear();
            const hours = date.getHours().toString().padStart(2, "0");
            const minutes = date.getMinutes().toString().padStart(2, "0");
            const seconds = date.getSeconds().toString().padStart(2, "0");
            return `${day}-${month}-${year} ${hours}:${minutes}:${seconds}`;
        },
        calculateGrandTotal(price, quantity) {
            return (price * quantity).toFixed(2);
        },
        calculateSubTotal(price, quantity) {
            return (price * quantity).toFixed(2);
        },
        productImagePath(image) {
            const imagePath = image
                ? "/storage/" + image.replace("public/", "")
                : "resources/js/Assets/Images/Image1.png";
            return imagePath;
        },
        showOrderDetails(order) {
            console.log = "aaaaaah";
            this.selectedOrder = order;
            this.isModalOpen = true;
        },
        closeModal() {
            this.isModalOpen = false;
        },
    },
};
</script>

<style lang="scss" scoped>
.orders-container {
    width: 100%;
    max-width: 95rem;

    .order-items-container {
        display: flex;
        flex-direction: column;
        gap: 20px;

        h3 {
            grid-column: 1 / -1;
            font-size: 18px;
        }

        .order-item {
            display: flex;
            align-items: center;
            border-bottom: 1px solid var(--color--secondary);
            .product-image img {
                width: 100px;
                aspect-ratio: 3/4;
                height: auto;
                margin-right: 20px;
            }

            .product-details {
                text-align: left;
                .product-title {
                    font-size: 16px;
                    font-weight: bold;
                    margin-bottom: 5px;
                }

                p {
                    margin: 0;
                }
            }
            .product-summary {
                margin-left: auto;
            }
        }

        .order-summary {
            background: var(--color--secondary);
            padding: 15px;
            border-radius: var(--rounded-box);
            display: flex;
            justify-content: end;
            gap: 16px;

            p {
                margin: 0;
            }
        }
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 0;
    }

    h3 {
        margin: 16px 0 8px 0;
        font-weight: 600;
        font-size: 18px;
    }

    strong {
        font-weight: 500;
        display: block;
        font-size: 17px;
    }

    p {
        text-wrap: wrap;
        margin-bottom: 8px;
        font-size: 16px;
        max-width: 30ch;
        text-overflow: ellipsis;
        overflow: hidden;
    }

    .orders-title {
        color: #333;
        margin-bottom: 20px;
    }

    .orders-tabs {
        display: flex;
        margin-bottom: 20px;

        .tab-button {
            padding: 10px 20px;
            border: none;
            background-color: #e0e0e0;
            cursor: pointer;
            margin-right: 5px;

            &.active {
                background-color: #0056b3;
                color: white;
            }
        }
    }

    .order-month-block {
        margin-bottom: 20px;

        h2 {
            font-size: 1.5rem;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }

        .order-card {
            display: flex;
            background-color: white;
            padding: 10px;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);

            .order-images {
                display: flex;
                gap: 10px;

                .product-image {
                    aspect-ratio: 3/4;
                    height: 100px;
                    background-color: #f3f3f3;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    overflow: hidden;

                    img {
                        width: 100%;
                        height: auto;
                    }
                }

                .placeholder-image {
                    aspect-ratio: 3/4;
                    height: 100px;
                    background-color: #f3f3f3;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 14px;
                    color: #ccc;
                }
            }

            .order-info {
                margin-left: 20px;
                flex-grow: 1;
                display: flex;

                justify-content: space-between;
                align-items: center;

                div {
                    flex-direction: column;
                    margin-bottom: 5px;
                }
            }
        }
    }

    .no-orders {
        text-align: center;
        color: #666;
    }
}
</style>
