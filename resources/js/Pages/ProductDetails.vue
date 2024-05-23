<template>
    <Head title="Product Details" />
    <MainLayout>
        <div class="container">
            <div class="inner-container">
                <!-- Images Container -->
                <div class="images-section">
                    <div class="thumbnail-images">
                        <img
                            v-for="image in product.images"
                            :key="image.id"
                            :src="productImagePath(image)"
                            :alt="product.title"
                            class="thumbnail-image"
                            @click="selectImage(image)"
                        />
                    </div>
                    <div class="main-image-container">
                        <img
                            :src="selectedImage"
                            alt="Selected Product Image"
                            class="main-image"
                        />
                    </div>
                </div>
                <!-- Product Details -->
                <div class="product-details">
                    <h1>{{ product.title }}</h1>
                    <p>&euro;{{ product.price }}</p>
                    <p>{{ product.description }}</p>
                    <div class="quantity-control">
                        <button @click="decreaseQuantity">-</button>
                        <input type="text" v-model="quantity" readonly />
                        <button @click="increaseQuantity">+</button>
                    </div>
                    <button class="w-full btn-primary" @click="addToCart">
                        Pievienot Grozam
                    </button>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import { usePage } from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import { Head } from "@inertiajs/vue3";
import { ref, onMounted, watch } from "vue";

const { product } = usePage().props;
const quantity = ref(1);
const selectedImage = ref("");

const productImagePath = (image) => {
    const imagePath = image.image
        ? "/storage/" + image.image.replace("public/", "")
        : "resources/js/Assets/Images/Image1.png";
    return imagePath;
};

const selectImage = (image) => {
    selectedImage.value = productImagePath(image);
};

onMounted(() => {
    if (product.images.length > 0) {
        selectImage(product.images[0]);
    }
});

watch(
    () => product.images,
    (newImages) => {
        if (newImages.length > 0) {
            selectImage(newImages[0]);
        }
    },
    { immediate: true }
);

const addToCart = async () => {
    try {
        const response = await axios.post("/cart", {
            product_id: product.id,
            quantity: quantity.value,
        });
        alert("Produkts pievienots grozam!");
    } catch (error) {
        console.error("Error adding to cart:", error);
        alert("Kļūda pievienojot produktu grozam!");
    }
};

const increaseQuantity = () => {
    if (quantity.value < 5) quantity.value++;
};

const decreaseQuantity = () => {
    if (quantity.value > 1) quantity.value--;
};
</script>

<style lang="scss" scoped>
.container {
    width: 100%;
    height: 100%;
    padding-inline: 0.5rem;
    display: flex;
    justify-content: center;
    background-image: linear-gradient(
        90deg,
        var(--color--secondary) 0%,
        var(--color--secondary) 50%,
        var(--color--light) 50%,
        var(--color--light) 100%
    );
    .inner-container {
        display: flex;
        justify-content: space-between;
        width: 100%;
        max-width: 75rem;

        .images-section {
            width: 100%;
            display: flex;
            padding: 96px;
            .thumbnail-images {
                display: flex;
                flex-direction: column;
                gap: 10px;
                img {
                    cursor: pointer;
                    width: 60px;
                    object-fit: cover;
                    border: 1px solid #ccc;
                    aspect-ratio: 3/4;
                }
            }
            .main-image-container {
                margin-left: 20px;
                position: relative;
                .main-image {
                    width: 100%;
                    object-fit: cover;
                    aspect-ratio: 3/4;
                }
            }
        }
        .product-details {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            width: 100%;
            padding: 96px;

            .quantity-control {
                display: flex;
                align-items: center;
                border: 1px solid var(--color--primary);
                border-radius: var(--rounded-elem);
                background-color: var(--color--white);
                width: fit-content;
                button {
                    width: 25px;
                    height: 25px;
                    padding: 0;
                    background-color: transparent;
                    color: var(--color--primary);
                    border: none;
                    cursor: pointer;
                    font-weight: 500;
                    font-size: 1.5rem;

                    &:hover {
                        scale: 1;
                    }
                }
                input {
                    font-size: 1.2rem;
                    padding: 8px 0;
                    width: 30px;
                    text-align: center;
                    margin: 0;
                    border: none;
                    outline: none;
                }
            }

            h1 {
            }

            p {
                font-size: 1.4rem;
            }
        }
    }
}
</style>
