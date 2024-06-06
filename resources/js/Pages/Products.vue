<template>
    <Head title="Produkti" />
    <MainLayout>
        <div class="banner-image">
            <h1 class="product-title">{{ categoryName }}</h1>
        </div>
        <div class="container">
            <div v-if="products.length === 0" class="no-products">
                <p>Šajā kategorijā nav produktu.</p>
            </div>
            <div v-else class="product-grid">
                <div
                    v-for="product in products"
                    :key="product.id"
                    class="product-card"
                    @mouseover="hoverImage(product)"
                    @mouseleave="unhoverImage(product)"
                >
                    <Link :href="`/products-customer/details/${product.id}`">
                        <div v-if="product.images.length" class="product-image">
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

const { products, categoryName } = usePage().props;
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
                border-radius: var(--rounded-box);
            }

            .tag-new-release {
                position: absolute;
                top: 0.3rem;
                left: 0.3rem;
                background-color: var(--color--secondary);
                color: var(--color--primary);
                padding: 0.75rem 0.75rem;
                font-size: 0.875rem;
                font-weight: 300;
                border-radius: var(--rounded-box);
            }
        }

        .product-info {
            padding: 0.3rem;

            .product-title {
                margin: 0;
                color: var(--color--dark);
            }

            .product-price {
                color: var(--color--dark);
            }
        }
    }
}
.banner-image {
    width: 100%;
    height: 25rem;
    background-image: url("@/Assets/Images/Image1.png");
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    display: flex;
    justify-content: center;
    align-items: center;
    h1 {
    }
}
</style>
