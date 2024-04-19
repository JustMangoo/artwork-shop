<template>
    <Head title="Printēti" />
    <MainLayout>
        <div class="container">
            <h2 class="products-title">Printētie Darbi</h2>
            <div class="product-grid">
                <div
                    v-for="product in products"
                    :key="product.id"
                    class="product-card"
                    @mouseover="hoverImage(product)"
                    @mouseleave="unhoverImage(product)"
                >
                    <Link :href="`/products/${product.id}`">
                        <div v-if="product.images.length" class="product-image">
                            <!-- Bind image source dynamically -->
                            <img
                                :src="getImageSrc(product)"
                                alt="Product Image"
                            />
                            <div
                                class="tag-new-release"
                                v-if="isNewRelease(product.created_at)"
                            >
                                Jaunums
                            </div>
                        </div>
                        <div class="product-info">
                            <p class="product-title">{{ product.title }}</p>
                            <p class="product-price">€{{ product.price }}</p>
                        </div>
                    </Link>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import { ref } from "vue";
import { usePage } from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";

const { products } = usePage().props;
const hoveredProduct = ref(null);

const isNewRelease = (dateString) => {
    const releaseDate = new Date(dateString);
    const fiveDaysAgo = new Date(new Date().setDate(new Date().getDate() - 5));
    return releaseDate >= fiveDaysAgo;
};

const getImageSrc = (product) => {
    if (hoveredProduct.value === product && product.images.length > 1) {
        return product.images[1].url;
    }
    return product.images[0].url;
};

const hoverImage = (product) => {
    if (product.images.length > 1) {
        hoveredProduct.value = product;
    }
};

const unhoverImage = (product) => {
    if (hoveredProduct.value === product) {
        hoveredProduct.value = null;
    }
};
</script>

<style lang="scss" scoped>
.container {
    max-width: 95rem;
    margin: 0 auto;
    padding: 2rem 0.5rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;

    .products-title {
        margin: 2rem 0;
        width: fit-content;
    }

    .product-grid {
        padding-top: 2rem;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.5rem;
        justify-content: center;
        @media (max-width: 1200px) {
            grid-template-columns: repeat(3, 1fr);
        }
        @media (max-width: 768px) {
            grid-template-columns: 1fr;
        }
    }

    .product-card {
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease-in-out;
        cursor: pointer;
        text-align: center;

        &:hover {
            transform: translateY(-5px);
        }

        .product-image {
            position: relative;
            line-height: 0;

            img {
                width: 100%;
                height: auto;
                aspect-ratio: 3/4;
                object-fit: cover;
                border-radius: var(--border-rad);
            }

            .tag-new-release {
                position: absolute;
                top: 0.3rem;
                left: 0.3rem;
                background-color: var(--secondary);
                color: var(--primary);
                padding: 0.75rem 0.75rem;
                font-size: 0.875rem;
                font-weight: 300;
                border-radius: var(--border-rad);
            }
        }

        .product-info {
            padding: 0.3rem;

            .product-title {
                margin: 0;
                font-size: 1rem;
                color: #333;
                font-weight: 200;
            }

            .product-price {
                font-size: 1rem;
                color: #333;
                font-weight: 200;
            }
        }
    }
}
</style>
