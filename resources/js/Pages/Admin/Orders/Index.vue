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
                                <div class="single-status">
                                    {{ order.status }}
                                </div>
                            </td>
                            <td>{{ order.total_price }}</td>
                            <td>{{ order.email }}</td>
                            <td>
                                <Link
                                    :href="route('orders.edit', order.id)"
                                    class="btn btn-edit"
                                    >Edit</Link
                                >
                                <button
                                    @click="deleteOrder(order.id)"
                                    class="btn btn-delete"
                                >
                                    Delete
                                </button>
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
        border-radius: var(--border-rad);
        overflow: hidden;

        table {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;

            thead {
                background-color: var(--primary);
                border-bottom: 0.3rem solid var(--light);

                tr {
                    th {
                        color: var(--light);
                        text-align: left;
                        padding: 0.5rem;
                        font-weight: 500;
                    }
                }
            }

            tbody {
                background-color: var(--secondary);

                tr {
                    border-bottom: 0.1rem solid var(--light);
                    border-left: 2px solid transparent;

                    &:hover {
                        box-sizing: border-box;
                        border-left: 2px solid var(--primary);
                    }

                    td {
                        color: var(--dark);
                        padding: 0.5rem;
                        vertical-align: middle;

                        .single-status {
                            width: fit-content;
                            padding: 0.1rem 0.4rem;
                            border: 1px solid var(--primary);
                            border-radius: var(--border-rad);
                        }

                        .product-image-field {
                            display: flex;
                            gap: 5px;
                            .product-image {
                                aspect-ratio: 3 / 4;
                                width: 3rem;
                                object-fit: cover;
                                display: block;
                                border-radius: var(--border-rad);
                            }
                        }

                        .action-icon {
                            display: inline;
                            margin-right: 0.5rem;
                            border-radius: var(--border-rad);
                            height: 2rem;
                            padding: 0.3rem;
                            background: var(--primary);
                            cursor: pointer;
                        }
                    }
                }
            }
        }
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
                    background-color: var(--secondary);
                    padding: 5px 10px;
                    border-radius: var(--border-rad);
                    display: block;
                    cursor: pointer;
                    user-select: none;

                    &:hover {
                        background-color: var(--secondary);
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
                        background-color: var(--primary);
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
