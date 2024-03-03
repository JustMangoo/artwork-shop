<template>
    <Head title="Produkti" />

    <MainLayout>
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
                        <div class="image-upload-container">
                            <div
                                v-for="(imageSrc, index) in imagePreviewUrls"
                                :key="index"
                                class="image-preview-container"
                            >
                                <img :src="imageSrc" class="image-preview" />
                                <button
                                    @click="removeImage(index)"
                                    class="remove-iamge-btn"
                                >
                                    <img
                                        src="../../Assets/xmark.svg"
                                        alt="close-icon"
                                    />
                                </button>
                            </div>
                            <div
                                v-if="!imagePreviewUrls.length"
                                @click="() => $refs.fileInput.click()"
                                class="image-upload-placeholder"
                            >
                                <img
                                    src="../../Assets/upload.svg"
                                    alt="upload"
                                />
                                <span>+</span>
                            </div>
                            <input
                                v-if="!imagePreviewUrls.length"
                                type="file"
                                id="image"
                                ref="fileInput"
                                @change="handleImageUpload"
                                class="hidden"
                                multiple
                            />
                        </div>
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
            images: [],
        });

        return { form };
    },
    methods: {
        removeImage(index) {
            this.imagePreviewUrls.splice(index, 1);
        },
        productImagePath(image) {
            console.log(`Processing image ID: ${image.id}`);
            const imagePath = image.image
                ? "/storage/" + image.image.replace("public/", "")
                : "resources/js/Assets/Images/Image1.png";

            console.log(`Image path for ${image.image}: ${imagePath}`);
            return imagePath;
        },
        handleImageUpload(event) {
            const files = event.target.files;
            this.form.images = []; // Reset the form images
            this.imagePreviewUrls = []; // Reset the preview URLs

            if (files) {
                for (let i = 0; i < files.length; i++) {
                    if (files[i].type.match("image.*")) {
                        this.form.images.push(files[i]);

                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.imagePreviewUrls.push(e.target.result);
                        };
                        reader.readAsDataURL(files[i]);
                    }
                }
            }
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
                    console.log("success");
                },
            });
        },
        resetForm() {
            this.form.reset();
            this.imagePreviewUrls = [];
            if (this.$refs.fileInput) {
                this.$refs.fileInput.value = null;
            }
        },
        editProduct(product) {
            this.form.reset();
            this.form.id = product.id;
            this.form.title = product.title;
            this.form.description = product.description;
            this.form.price = product.price;
            this.form.categories = product.categories.map(
                (category) => category.id
            );

            // Ensure `product.images` is defined and is an array before calling `map`
            if (Array.isArray(product.images)) {
                this.imagePreviewUrls = product.images.map((image) => {
                    return image.path
                        ? "/storage/" + image.path.replace("public/", "")
                        : "resources/js/Assets/Images/Image1.png";
                });
            } else {
                this.imagePreviewUrls = []; // If `product.images` is not an array, set `imagePreviewUrls` to an empty array
            }

            if (this.$refs.fileInput) {
                this.$refs.fileInput.value = null;
            }

            this.isAddProductModalOpen = true;
        },
        deleteProduct(product) {
            if (confirm(`Are you sure you want to delete ${product.title}?`)) {
                this.$inertia.delete(route("products.destroy", product.id), {
                    onSuccess: () => {
                        console.log("Product deleted successfully");
                    },
                    onError: (errors) => {
                        console.error("Error deleting product", errors);
                    },
                });
            }
        },
    },
    data() {
        return {
            isAddProductModalOpen: false,
            imagePreviewUrls: [],
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

    .image-upload-container {
        width: 30%;
        aspect-ratio: 3 / 4;
        border: 2px dashed #ccc;
        border-radius: var(--border-rad);
        position: relative;
        cursor: pointer;

        .image-upload-placeholder {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;

            img {
                max-width: 50%;
                max-height: 50%;
                object-fit: cover;
            }

            span {
                position: absolute;
                bottom: 15px;
                right: 15px;
                font-size: 24px;
            }
        }

        .image-preview {
            object-fit: cover;
            aspect-ratio: 3/ 4;
        }
        .remove-iamge-btn {
            position: absolute;
            top: -8px;
            right: -8px;

            img {
                width: 20px;
                background-color: var(--primary);
                border-radius: 50%;
            }
        }
    }

    .hidden {
        display: none;
    }
}
</style>
