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
                    <p>{{ product.category.name }}</p>
                    <p>{{ product.description }}</p>
                    <hr />
                    <p class="price">&euro;{{ product.price }}</p>
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

<script>
import { usePage } from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import { Head } from "@inertiajs/vue3";

export default {
    components: {
        MainLayout,
        Head,
    },

    data() {
        return {
            product: this.$page.props.product,
            quantity: 1,
            selectedImage: "",
        };
    },

    computed: {
        productImagePath() {
            return (image) => {
                const imagePath = image.image
                    ? "/storage/" + image.image.replace("public/", "")
                    : "resources/js/Assets/Images/Image1.png";
                return imagePath;
            };
        },
    },

    methods: {
        selectImage(image) {
            this.selectedImage = this.productImagePath(image);
        },
        addToCart() {
            this.$inertia.post(
                "/cart",
                {
                    product_id: this.product.id,
                    quantity: this.quantity,
                },
                {
                    onError: (errors) => {
                        console.error("Error adding to cart:", errors);
                    },
                    onSuccess: () => {
                        console.log("Added to cart successfully!");
                    },
                }
            );
        },
        increaseQuantity() {
            if (this.quantity < 5) this.quantity++;
        },
        decreaseQuantity() {
            if (this.quantity > 1) this.quantity--;
        },
    },

    mounted() {
        if (this.product.images.length > 0) {
            this.selectImage(this.product.images[0]);
        }
    },

    watch: {
        "product.images": function (newImages) {
            if (newImages.length > 0) {
                this.selectImage(newImages[0]);
            }
        },
    },
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
        var(--color--white) 50%,
        var(--color--white) 100%
    );
    .inner-container {
        display: flex;
        justify-content: space-between;
        width: 100%;
        max-width: 75rem;

        .images-section {
            width: 100%;
            display: flex;
            padding: 96px 96px 96px 0;
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
                    box-shadow: 0px 20px 40px -35px rgba(0, 0, 0, 0.75);
                }
            }
        }
        .product-details {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            width: 100%;
            padding: 96px;
            h1 {
                font-size: 3.5rem;
            }

            p {
                font-size: 1.2rem;
            }

            .price {
                font-weight: 500;
                font-size: 2rem;
            }

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
        }
    }
}
</style>
