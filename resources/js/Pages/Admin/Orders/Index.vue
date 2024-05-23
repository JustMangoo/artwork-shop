<template>
    <Head title="Order Management" />
    <AdminLayout>
        <div class="container">
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Status</th>
                            <th>Total Price</th>
                            <th>Email</th>
                            <th>Actions</th>
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
                                <img />
                                <svg
                                    :href="route('orders.edit', order.id)"
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
        </div>
    </AdminLayout>
</template>

<script setup>
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

const props = defineProps({
    orders: Array,
});

function deleteOrder(orderId) {
    if (confirm("Are you sure you want to delete this order?")) {
        Inertia.delete(route("orders.destroy", orderId));
    }
}
</script>

<style lang="scss" scoped>
.container {
    max-width: 95rem;
    padding: 1rem 0.5rem;
    display: flex;
    flex-direction: column;
    gap: 1rem;
    overflow: hidden;

    .table-container {
        border-radius: var(--rounded-box);
        overflow: hidden;
    }
    .image-category {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;

        .images-input-box {
            width: 100%;
            .images-input {
                width: 100%;
                display: flex;
                flex-direction: row;
                gap: 1rem;
            }
        }

        .categories-input {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;

            .radio-tag {
                display: flex;
                align-items: center;

                .tag-label {
                    background-color: var(--color--secondary);
                    padding: 5px 10px;
                    border-radius: var(--rounded-box);
                    display: block;
                    cursor: pointer;
                    user-select: none;

                    &:hover {
                        background-color: var(--color--secondary);
                    }

                    &::before {
                        content: url(@/Assets/check.svg);
                        display: inline-block;
                        width: 0;
                        height: 100%;
                        margin-right: 0;
                        transition: all 0.5s;
                        transform: translate(0, 2px);
                    }
                }

                input[type="radio"] {
                    display: none;

                    &:checked + .tag-label {
                        background-color: var(--color--primary);
                        color: white;
                        text-align: center;

                        &::before {
                            content: url(@/Assets/check.svg);
                            display: inline-block;
                            width: 1rem;
                            height: 100%;
                            margin-right: 0.2rem;
                        }
                    }
                }
            }
        }
    }

    .hidden {
        display: none;
    }
}
</style>
