<template>
    <Head title="Product Details" />
    <MainLayout>
        <div class="container">
            <!-- Images Container -->
            <div class="product-images">
                <img
                    v-for="image in product.images"
                    :key="image.id"
                    :src="productImagePath(image)"
                    :alt="product.title"
                    class="product-image"
                />
            </div>
            <!-- Product Details -->
            <div class="product-details">
                <h1>{{ product.title }}</h1>
                <p>&euro;{{ product.price }}</p>
                <p>{{ product.description }}</p>
                <PrimaryButton @click="addToCart"
                    >Pievienot Grozam</PrimaryButton
                >
                <SecondaryButton>Pirkt Tagad</SecondaryButton>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import { usePage } from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import { Head } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

const productImagePath = (image) => {
    const imagePath = image.image
        ? "/storage/" + image.image.replace("public/", "")
        : "resources/js/Assets/Images/Image1.png";
    return imagePath;
};

const addToCart = async () => {
    console.log("test");
    try {
        const response = await axios.post("/cart", {
            product_id: product.id,
            quantity: 1,
        });
        alert("Produkts pievienots grozam!");
    } catch (error) {
        console.error("Error adding to cart:", error);
        alert("Kļūda pievienojot produktu grozam!");
    }
};

const { product } = usePage().props;
</script>

<style lang="scss" scoped>
.container {
    display: flex;
    justify-content: space-between;
    max-width: 75rem;
    padding-inline: 0.5rem;
    gap: 2.5rem;
    margin: 2rem 0;

    .product-images {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
        min-width: 60%;
        .product-image {
            aspect-ratio: 3/ 4;
            object-fit: cover;
            width: 100%;
        }
    }
    .product-details {
        min-width: 40%;
        display: flex;
        flex-direction: column;
        gap: 1rem;

        h1 {
        }

        p {
            font-size: 1.4rem;
        }
    }
}
</style>
