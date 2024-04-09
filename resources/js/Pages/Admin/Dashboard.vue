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
                    <div class="info-text">
                        <span>0</span>
                        <p>Jaunas ziņas</p>
                    </div>
                </div>
                <div class="box">
                    <div class="info-text">
                        <span>0</span>
                        <p>Jaunas ziņas</p>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { usePage } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head } from "@inertiajs/vue3";

const { productCount, userCount, subscriptionCount } = usePage().props;
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
            border-radius: var(--border-rad);
            width: 100%;
            background-color: var(--secondary);
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
                background-color: var(--primary);
                padding: 0.5rem;
                border-radius: 50%;
            }
        }
    }

    .detailed-info {
        width: 100%;
        padding: 0 0.5rem;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-template-rows: 1fr;
        grid-column-gap: 1rem;
        grid-row-gap: 1rem;
        margin: 1rem 0;

        .box {
            padding: 1rem;
            border-radius: var(--border-rad);
            width: 100%;
            background-color: var(--secondary);
            min-height: 2rem;
            display: flex;
            justify-content: space-between;
            flex-direction: row;
        }
    }
}
</style>
