<template>
    <Head title="Panelis" />

    <AdminLayout>
        <div class="container">
            <div class="quick-info">
                <div class="box">
                    <div class="info-text">
                        <span>{{ $page.props.auth.user.name }}</span>
                        <p>Lietotājs</p>
                    </div>
                </div>
                <div class="box">
                    <div class="info-text">
                        <span>{{ productCount }}</span>
                        <p>Produktu skaits</p>
                    </div>
                    <img
                        src="@/Assets/list-white.svg"
                        alt=""
                        class="info-icon"
                    />
                </div>
                <div class="box">
                    <div class="info-text">
                        <span>{{ userCount }}</span>
                        <p>Lietotāju skaits</p>
                    </div>
                    <img
                        src="@/Assets/user-white.svg"
                        alt=""
                        class="info-icon"
                    />
                </div>
                <div class="box">
                    <div class="info-text">
                        <span>{{ subscriptionCount }}</span>
                        <p>Abonamenti</p>
                    </div>
                    <img
                        src="@/Assets/mail-white.svg"
                        alt=""
                        class="info-icon"
                    />
                </div>
            </div>
            <div class="detailed-info">
                <div class="box">
                    <h2>Aktīvi Pasūtījumi</h2>
                    <table cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Statuss</th>
                                <th>Klienta Vārds</th>
                                <th>Pilna Cena</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="order in activeOrders" :key="order.id">
                                <td>{{ order.id }}</td>
                                <td>{{ order.status }}</td>
                                <td>{{ order.full_name }}</td>
                                <td>{{ order.total_price }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { usePage } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head } from "@inertiajs/vue3";

const { productCount, userCount, subscriptionCount, activeOrders } =
    usePage().props;
</script>

<style lang="scss" scoped>
span {
    font-weight: 400;
    font-size: 25px;
}

.container {
    max-width: 95rem;
    .quick-info {
        width: 100%;
        padding: 0 0.5rem;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        grid-template-rows: 1fr;
        grid-column-gap: 1rem;
        grid-row-gap: 1rem;
        margin: 1rem 0;

        .box {
            padding: 1rem;
            border-radius: var(--rounded-box);
            width: 100%;
            background-color: var(--color--secondary);
            min-height: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-direction: row;

            .info-text {
            }
            .info-icon {
                aspect-ratio: 1/1;
                width: 20%;
                margin-right: 1rem;
                background-color: var(--color--primary);
                padding: 0.5rem;
                border-radius: 50%;
            }
        }
    }

    .detailed-info {
        width: 100%;

        display: grid;
        grid-template-columns: repeat(1, 1fr);
        grid-template-rows: 1fr;
        grid-column-gap: 1rem;
        grid-row-gap: 1rem;
        margin: 1rem 0;

        .box {
            border-radius: var(--rounded-box);
            border: 1px solid var(--color--secondary);
            width: 100%;
            min-height: 2rem;
            display: flex;
            justify-content: space-between;
            flex-direction: column;

            h2 {
                padding: 1rem;
                background-color: var(--color--secondary);
            }
        }
    }
}
</style>
