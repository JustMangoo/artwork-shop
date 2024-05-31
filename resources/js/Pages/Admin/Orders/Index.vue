<template>
    <Head title="Order Management" />
    <AdminLayout>
        <div class="container">
            <header class="header">
                <h1>Pasūtījumi</h1>
            </header>
            <div class="main-content">
                <aside class="filters">
                    <div class="filters-header">
                        <h2>Filtrēšana</h2>
                        <svg
                            @click="resetFilters"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g
                                id="SVGRepo_tracerCarrier"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            ></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M3 8H16.5C18.9853 8 21 10.0147 21 12.5C21 14.9853 18.9853 17 16.5 17H3M3 8L6 5M3 8L6 11"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                ></path>
                            </g>
                        </svg>
                    </div>

                    <div class="search-wrapper">
                        <input
                            v-model="searchTerm"
                            type="text"
                            class="search-input"
                            @keyup.enter="performSearch"
                        />
                        <button class="search-button" @click="performSearch">
                            <img src="@/Assets/search.svg" alt="search icon" />
                        </button>
                    </div>

                    <div class="category-search-container">
                        <div @click="toggleDropdown" class="dropdown-button">
                            {{ selectedStatus || "Visi Statusi" }}
                            <img src="@/Assets/arrow.svg" alt="arrow-icon" />
                        </div>
                        <div v-if="dropdownActive" class="dropdown-content">
                            <div
                                v-for="status in statusOptions"
                                :key="status.value"
                                @click="selectStatus(status)"
                                class="dropdown-item"
                            >
                                {{ status.text }}
                            </div>
                        </div>
                    </div>
                </aside>
                <div class="table-container">
                    <table cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Vārds</th>
                                <th>Epasts</th>
                                <th>Status</th>
                                <th>Pilna Cena</th>

                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="order in orders" :key="order.id">
                                <td>{{ order.id }}</td>
                                <td>{{ order.full_name }}</td>
                                <td>{{ order.email }}</td>
                                <td>
                                    <div class="table-badge">
                                        {{ order.status }}
                                    </div>
                                </td>
                                <td>{{ order.total_price }}</td>

                                <td>
                                    <svg
                                        @click="showOrderDetails(order)"
                                        class="action-btn"
                                        viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <g
                                            id="SVGRepo_bgCarrier"
                                            stroke-width="0"
                                        ></g>
                                        <g
                                            id="SVGRepo_tracerCarrier"
                                            stroke-linecap="sharp"
                                            stroke-linejoin="sharp"
                                        ></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M18 12H18.01M12 12H12.01M6 12H6.01M13 12C13 12.5523 12.5523 13 12 13C11.4477 13 11 12.5523 11 12C11 11.4477 11.4477 11 12 11C12.5523 11 13 11.4477 13 12ZM19 12C19 12.5523 18.5523 13 18 13C17.4477 13 17 12.5523 17 12C17 11.4477 17.4477 11 18 11C18.5523 11 19 11.4477 19 12ZM7 12C7 12.5523 6.55228 13 6 13C5.44772 13 5 12.5523 5 12C5 11.4477 5.44772 11 6 11C6.55228 11 7 11.4477 7 12Z"
                                                stroke-width="2"
                                                stroke-linecap="sharp"
                                                stroke-linejoin="sharp"
                                            ></path>
                                        </g>
                                    </svg>

                                    <img
                                        @click="deleteOrder(order.id)"
                                        class="action-btn"
                                        src="@/Assets/trash.svg"
                                    />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <Modal
                    v-if="isModalOpen"
                    @close="closeModal"
                    :showSidebar="true"
                >
                    <template #header>
                        <h2>#{{ selectedOrder.id }} Pasūtījums</h2>
                    </template>
                    <template #content class="modal-content">
                        <div class="order-items-container">
                            <h3>
                                Pasūtījuma preces ({{
                                    selectedOrder.items.length
                                }})
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
                                        >€{{
                                            selectedOrder.total_price
                                        }}</strong
                                    >
                                    <p>€0.00</p>
                                    <p>€0.00</p>
                                    <strong
                                        >€{{
                                            selectedOrder.total_price
                                        }}</strong
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
                            {{ formatDate(selectedOrder.created_at) }}
                        </p>

                        <div>
                            <label for="order-status"
                                ><strong>Statuss:</strong></label
                            >
                            <select
                                v-model="selectedOrder.status"
                                id="order-status"
                            >
                                <option value="paid">Apmaksāts</option>
                                <option value="shipped">Izsūtīts</option>
                                <option value="completed">Pabeigts</option>
                            </select>
                        </div>
                        <button @click="updateOrderStatus">
                            Manīt statusu
                        </button>
                    </template>
                    <template #footer>
                        <button @click="closeModal">Aizvērt</button>
                    </template>
                </Modal>
            </div>
        </div>
    </AdminLayout>
</template>

<script>
import { ref, computed } from "vue";
import Modal from "@/Components/Modal.vue";
import { Inertia } from "@inertiajs/inertia";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

export default {
    components: {
        AdminLayout,
        Modal,
        Head,
        Link,
    },
    props: {
        orders: Array,
    },
    data() {
        return {
            isModalOpen: false,
            selectedOrder: {},
            showSearch: false,
            isSearchVisible: false,
            searchTerm: "",
            selectedStatus: null,
            dropdownActive: false,
            statusOptions: [
                { value: "pending", text: "Gaida atbildi" },
                { value: "paid", text: "Atmaksāts" },
                { value: "shipped", text: "Izsūtīts" },
                { value: "completed", text: "Pabeigts" },
                { value: "cancelled", text: "Atcelts" },
            ],
        };
    },
    methods: {
        toggleDropdown() {
            this.dropdownActive = !this.dropdownActive;
        },
        selectStatus(status) {
            this.selectedStatus = status.value;
            this.dropdownActive = false;
            this.performSearch();
        },
        resetFilters() {
            this.searchTerm = "";
            this.selectedStatus = null;
            this.performSearch();
        },
        performSearch() {
            this.$inertia.get(
                route("orders.index"),
                {
                    search: this.searchTerm,
                    status: this.selectedStatus,
                },
                {
                    preserveState: true,
                    preserveScroll: true,
                }
            );
        },
        productImagePath(image) {
            const imagePath = image
                ? "/storage/" + image.replace("public/", "")
                : "resources/js/Assets/Images/Image1.png";
            return imagePath;
        },
        formatDate(dateString) {
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
        deleteOrder(orderId) {
            if (confirm("Are you sure you want to delete this order?")) {
                Inertia.delete(route("orders.destroy", orderId));
            }
        },
        showOrderDetails(order) {
            this.selectedOrder = order;
            this.isModalOpen = true;
        },
        closeModal() {
            this.isModalOpen = false;
        },
        updateOrderStatus() {
            const formData = {
                status: this.selectedOrder.status,
            };
            this.$inertia.patch(
                route("orders.update", this.selectedOrder.id),
                formData,
                {
                    onSuccess: () => {
                        this.closeModal();
                        this.$emit("order-updated");
                    },
                    onError: (errors) => {
                        console.log("Error updating order:", errors);
                    },
                }
            );
        },
    },
};
</script>

<style lang="scss" scoped>
.container {
    display: flex;
    flex-direction: column;
    max-width: 95rem;
    margin: 0 auto;
    padding-inline: 0.5rem;

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

    .main-content {
        display: grid;
        grid-template-columns: 300px 1fr;
        gap: 1rem;

        .filters {
            width: 100%;
            height: fit-content;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            border-radius: var(--rounded-box);
            border: 1px solid var(--color--secondary);
            padding: 4px;

            .filters-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 6px 8px;
                background-color: var(--color--secondary);
                h2 {
                    font-size: 1.563rem;
                }

                svg {
                    height: 2rem;
                    stroke: var(--color--primary);
                    cursor: pointer;
                }
            }

            .search-wrapper {
                display: flex;
                padding: 8px;

                .search-input {
                    border-bottom: 2px solid var(--color--secondary);
                    padding: 0.5rem 0;
                    max-width: 100%;
                    transition: all 0.3s ease-in-out;
                    opacity: 1;
                    border-radius: var(--rounded-box) 0 0 var(--rounded-box);
                    outline: 0;

                    &:focus {
                        border-bottom: 2px solid var(--color--primary);
                    }
                }

                .search-button {
                    border-radius: 0 var(--rounded-box) var(--rounded-box) 0;
                    width: fit-content;
                    img {
                        height: 1rem;
                    }
                }
            }

            .category-search-container {
                padding: 8px;
                position: relative;
                .dropdown-button {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    padding: 0.5rem 1rem;
                    background-color: var(--color--primary);
                    color: white;
                    border-radius: var(--rounded-box);
                    cursor: pointer;
                    height: 100%;

                    img {
                        height: 1.5rem;
                    }
                }

                .dropdown-content {
                    position: absolute;
                    top: 100%;
                    left: 0;
                    right: 0;
                    background-color: var(--color--secondary);
                    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
                    z-index: 60;
                    border-radius: 0 0 var(--rounded-box) var(--rounded-box);

                    .dropdown-item {
                        padding: 0.5rem 1rem;
                        cursor: pointer;
                        &:hover {
                            background-color: var(--color--light-primary);
                        }
                    }
                }
            }
        }

        .table-container {
            overflow: auto;
        }
    }
}
</style>
