<template>
    <Head title="Produkti" />

    <MainLayout>
        <SystemMessage :message="systemMessage" :type="messageType" />
        <div class="container">
            <div class="option-container">
                <BasicButton class="search-button">
                    <img src="../../Assets/plus.svg" alt="plus icon" />
                    Meklēt
                </BasicButton>
                <BasicButton
                    class="add-button"
                    @click="isAddProductModalOpen = true"
                >
                    <img src="../../Assets/plus.svg" alt="plus icon" />
                    Jauns
                </BasicButton>
                <FormModalLayout
                    v-model:showModal="isAddProductModalOpen"
                    @submit="addProduct"
                >
                    <template #header><h2>Pievienot Produktu</h2></template>

                    <template #body class="modal-content">
                        <!-- (input fields) -->
                        <div>
                            <InputLabel for="title">Nosaukums:</InputLabel>
                            <TextInput id="title" v-model="form.title" />
                            <InputError
                                :message="form.errors.title"
                                class="mt-2"
                            />
                        </div>
                        <div>
                            <InputLabel for="description">Apraksts:</InputLabel>
                            <TextArea
                                id="description"
                                v-model="form.description"
                            ></TextArea>
                            <InputError
                                :message="form.errors.description"
                                class="mt-2"
                            />
                        </div>
                        <div>
                            <InputLabel for="price">Cena:</InputLabel>
                            <TextInput id="price" v-model="form.price" />
                            <InputError
                                :message="form.errors.price"
                                class="mt-2"
                            />
                        </div>
                        <div>
                            <InputLabel for="categories"
                                >Kategorijas:</InputLabel
                            >
                            <div class="categories-container">
                                <div
                                    v-for="category in categories"
                                    :key="category.id"
                                    class="checkbox-tag"
                                >
                                    <input
                                        type="checkbox"
                                        :id="'category-' + category.id"
                                        :value="category.id"
                                        v-model="form.categories"
                                    />
                                    <label
                                        :for="'category-' + category.id"
                                        class="tag-label"
                                    >
                                        {{ category.name }}
                                    </label>
                                </div>
                            </div>
                            <InputError
                                :message="form.errors.categories"
                                class="mt-2"
                            />
                        </div>
                        <ImageUploadComponent
                            :initial-image="initialImage"
                            @image-added="handleImageAdded"
                            @image-removed="handleImageRemoved"
                        />
                    </template>

                    <template #footer>
                        <!-- Modal footer content -->
                        <BasicButton
                            class="cancel-btn"
                            @click="
                                isAddProductModalOpen = false;
                                resetForm();
                            "
                        >
                            Atcelt
                        </BasicButton>
                        <BasicButton class="submit-btn" @click="addProduct">
                            Saglabāt
                        </BasicButton>
                    </template>
                </FormModalLayout>
            </div>
            <!-- Product table -->
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Produkta nosaukums</th>
                            <th>Apraksts</th>
                            <th>Cena</th>
                            <th>Kategorīja</th>
                            <th>Bilde</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="product in products" :key="product.id">
                            <td>
                                {{ product.title }}
                            </td>
                            <td>
                                {{ product.description }}
                            </td>
                            <td>{{ product.price }}&euro;</td>
                            <td>
                                <ul>
                                    <li
                                        v-for="category in product.categories"
                                        :key="category.id"
                                    >
                                        {{ category.name }},<br />
                                    </li>
                                </ul>
                            </td>
                            <td>
                                <div>
                                    <img
                                        v-for="image in product.images"
                                        :key="image.id"
                                        :src="productImagePath(image)"
                                        alt="Product Image"
                                        class="product-image"
                                    />
                                </div>
                            </td>
                            <td>
                                <img
                                    class="action-icon"
                                    src="../../Assets/pen.svg"
                                    alt="edit-icon"
                                    @click="editProduct(product)"
                                />
                                <img
                                    class="action-icon"
                                    src="../../Assets/trash.svg"
                                    alt="delete-icon"
                                    @click="deleteProduct(product)"
                                />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </MainLayout>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import BasicButton from "@/Components/BasicButton.vue";
import FormModalLayout from "@/Layouts/FormModalLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import TextArea from "@/Components/TextArea.vue";
import ImageUploadComponent from "@/Components/ImageUploadComponent.vue";
import SystemMessage from "@/Components/SystemMessage.vue";
import { Head } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";

export default {
    components: {
        MainLayout,
        Head,
        BasicButton,
        FormModalLayout,
        InputError,
        InputLabel,
        TextInput,
        TextArea,
        ImageUploadComponent,
        SystemMessage,
    },
    props: {
        products: Array,
        categories: Array,
    },
    setup() {
        const form = useForm({
            id: null,
            title: "",
            description: "",
            price: null,
            categories: [],
            image: null,
        });

        return { form };
    },
    methods: {
        handleImageAdded(imageData) {
            console.log("imageData: " + imageData);
            this.form.image = imageData;
        },
        handleImageRemoved() {
            this.form.image = null;
        },
        removeImage(index) {
            this.imagePreviewUrls.splice(index, 1);
        },
        productImagePath(image) {
            const imagePath = image.image
                ? "/storage/" + image.image.replace("public/", "")
                : "resources/js/Assets/Images/Image1.png";
            return imagePath;
        },
        addProduct() {
            const url = this.form.id
                ? route("products.update", this.form.id)
                : route("products.store");
            const method = this.form.id ? "put" : "post";

            this.form[method](url, {
                onSuccess: () => {
                    this.isAddProductModalOpen = false;
                    this.form.reset();
                    this.setSystemMessage(
                        this.isEditMode
                            ? "Product updated successfully"
                            : "Product added successfully",
                        "success"
                    );
                    this.isEditMode = false;
                },
                onError: () => {
                    this.setSystemMessage(
                        "An error occurred while saving the product",
                        "error"
                    );
                },
            });
        },
        resetForm() {
            this.form.reset();
            this.imagePreviewUrls = [];
            this.isEditMode = false;
            if (this.$refs.fileInput) {
                this.$refs.fileInput.value = null;
            }
            this.initialImage = null;
        },
        editProduct(product) {
            this.isEditMode = true;

            this.form.reset();
            this.form.id = product.id;
            this.form.title = product.title;
            this.form.description = product.description;
            this.form.price = product.price;
            this.form.categories = product.categories.map(
                (category) => category.id
            );

            // Check if images array is present and has at least one image.
            if (Array.isArray(product.images) && product.images.length > 0) {
                const firstImagePath = product.images[0].image;
                this.initialImage = firstImagePath
                    ? "/storage/" + firstImagePath.replace("public/", "")
                    : "resources/js/Assets/Images/Image2.png";
            } else {
                // Default image if no image is associated with the product
                this.initialImage = "resources/js/Assets/Images/Image2.png";
            }

            // Assuming product.images is the array containing image objects
            this.imagePreviewUrls = product.images
                .map((image) => {
                    return image.image
                        ? "/storage/" + image.image.replace("public/", "")
                        : null;
                })
                .filter((url) => url !== null);

            if (this.$refs.fileInput) {
                this.$refs.fileInput.value = null;
            }

            this.isAddProductModalOpen = true;
        },
        deleteProduct(product) {
            if (confirm(`Are you sure you want to delete ${product.title}?`)) {
                this.$inertia.delete(route("products.destroy", product.id), {
                    onSuccess: () => {
                        this.setSystemMessage(
                            "Product deleted successfully",
                            "success"
                        );
                    },
                    onError: (errors) => {
                        this.setSystemMessage(
                            "An error occurred while deleting the product",
                            "error"
                        );
                    },
                });
            }
        },
        setSystemMessage(message, type = "info") {
            this.systemMessage = message;
            this.messageType = type;
        },
    },
    data() {
        return {
            isAddProductModalOpen: false,
            imagePreviewUrls: [],
            initialImage: null,
            isEditMode: false,
            systemMessage: "",
            messageType: "info",
        };
    },
};
</script>

<style lang="scss" scoped>
.container {
    max-width: 95rem;
    padding: 1rem 0.5rem;
    display: flex;
    flex-direction: column;
    gap: 1rem;

    .option-container {
        max-width: 100%;
        display: flex;
        justify-content: space-between;

        .add-button,
        .search-button {
            width: fit-content;
            img {
                height: 1.5rem;
            }
        }
    }

    .table-container {
        border-radius: var(--border-rad);
        overflow: hidden;

        table {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;

            thead {
                background-color: var(--primary);
                border-bottom: 0.3rem solid var(--neutral-one);

                tr {
                    th {
                        color: var(--neutral-one);
                        text-align: left;
                        padding: 0.5rem;
                        font-weight: 500;
                    }
                }
            }

            tbody {
                background-color: var(--secondary);

                tr {
                    border-bottom: 0.1rem solid var(--neutral-one);
                    border-left: 2px solid transparent;

                    &:hover {
                        box-sizing: border-box;
                        border-left: 2px solid var(--primary);
                    }

                    td {
                        color: var(--neutral-two);
                        padding: 0.5rem;
                        vertical-align: middle;

                        .product-image {
                            aspect-ratio: 3 / 4;
                            width: 20%;
                            object-fit: cover;
                            margin: 0 auto;
                            display: block;
                            border-radius: var(--border-rad);
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

    .categories-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;

        .checkbox-tag {
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
                    content: url(../../Assets/check.svg);
                    display: inline-block;
                    width: 0;
                    height: 100%;
                    margin-right: 0;
                    transition: all 0.5s;
                    transform: translate(0, 2px);
                }
            }

            input[type="checkbox"] {
                display: none;

                &:checked + .tag-label {
                    background-color: var(--primary);
                    color: white;
                    text-align: center;

                    &::before {
                        content: url(../../Assets/check.svg);
                        display: inline-block;
                        width: 1rem;
                        height: 100%;
                        margin-right: 0.2rem;
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
