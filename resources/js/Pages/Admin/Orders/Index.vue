<template>
    <Head title="Order Management" />
    <AdminLayout>
        <div class="container">
            <header class="header">
                <h1>Pasūtījumi</h1>
            </header>
            <div class="main-content">
                <aside class="filters">
                    <h2>Filtrēšana</h2>
                </aside>
                <div class="table-container">
                    <table cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Status</th>
                                <th>Pilna Cena</th>
                                <th>Epasts</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="order in orders" :key="order.id">
                                <td>{{ order.id }}</td>
                                <td>
                                    <div class="table-badge">
                                        {{ order.status }}
                                    </div>
                                </td>
                                <td>{{ order.total_price }}</td>
                                <td>{{ order.email }}</td>
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
                        <h2>Order Details for #{{ selectedOrder.id }}</h2>
                    </template>
                    <template #content class="modal-content">
                        <div class="order-details">
                            <div>
                                <p>
                                    <strong>Full Name:</strong>
                                    {{ selectedOrder.full_name }}
                                </p>
                                <p>
                                    <strong>Phone Number:</strong>
                                    {{ selectedOrder.phone_number }}
                                </p>
                                <p>
                                    <strong>Shipping Address:</strong>
                                    {{ selectedOrder.shipping_address }},
                                    {{ selectedOrder.shipping_city }},
                                    {{ selectedOrder.shipping_country }}
                                    {{ selectedOrder.shipping_postal_code }}
                                </p>
                                <p>
                                    <strong>Session ID:</strong>
                                    {{ selectedOrder.session_id }}
                                </p>
                                <p>
                                    <strong>Created At:</strong>
                                    {{ selectedOrder.created_at }}
                                </p>
                                <p>
                                    <strong>Updated At:</strong>
                                    {{ selectedOrder.updated_at }}
                                </p>
                                <strong>Items:</strong>
                                <ul>
                                    <li
                                        v-for="item in selectedOrder.items"
                                        :key="item.id"
                                    >
                                        {{ item.product.title }} - Quantity:
                                        {{ item.quantity }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </template>
                    <template #side-content
                        ><p>Status: {{ selectedOrder.status }}</p>
                        <p>Total Price: €{{ selectedOrder.total_price }}</p>
                        <p>Email: {{ selectedOrder.email }}</p>
                    </template>
                    <template #footer>
                        <button @click="closeModal">Close</button>
                    </template>
                </Modal>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { ref, computed } from "vue";
import Modal from "@/Components/Modal.vue";
import { Inertia } from "@inertiajs/inertia";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

const props = defineProps({
    orders: Array,
});

const isModalOpen = ref(false);
const selectedOrder = ref({});

function deleteOrder(orderId) {
    if (confirm("Are you sure you want to delete this order?")) {
        Inertia.delete(route("orders.destroy", orderId));
    }
}

function showOrderDetails(order) {
    selectedOrder.value = order;
    isModalOpen.value = true;
}

function closeModal() {
    isModalOpen.value = false;
}
</script>

<style lang="scss" scoped>
.container {
    display: flex;
    flex-direction: column;
    max-width: 95rem;
    margin: 0 auto;
    padding-inline: 0.5rem;

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 0;
    }

    .main-content {
        display: grid;
        grid-template-columns: 300px 1fr;
        gap: 1rem;

        .filters {
            border-radius: var(--rounded-box);
            border: 1px solid var(--color--secondary);
            padding: 4px;
            height: fit-content;

            h2 {
                background-color: var(--color--secondary);
                font-size: 1.563rem;
                padding: 6px 8px;
            }
        }

        .table-container {
            overflow: auto;
        }
    }
}
</style>
