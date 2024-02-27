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
                        <div>
                            <InputLabel for="image">Product Image:</InputLabel>
                            <input
                                type="file"
                                id="image"
                                @change="handleImageUpload"
                            />
                            <!-- Image preview -->
                            <div class="image-preview-container">
                                <img
                                    v-if="imagePreviewUrl"
                                    :src="imagePreviewUrl"
                                    alt="Image preview"
                                    class="image-preview"
                                />
                                <img
                                    v-if="imagePreviewUrl"
                                    :src="imagePreviewUrl"
                                    alt="Image preview"
                                    class="image-preview"
                                />
                                <img
                                    v-if="imagePreviewUrl"
                                    :src="imagePreviewUrl"
                                    alt="Image preview"
                                    class="image-preview"
                                />
                            </div>
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
                                <img
                                    :src="productImagePath(product.image_path)"
                                    alt="Product Image"
                                    class="product-image"
                                />
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
            image: null,
        });

        return { form };
    },
    methods: {
        productImagePath(path) {
            return path
                ? "/storage/" + path.replace("public/", "")
                : "/images/default-product.jpg";
        },
        handleImageUpload(event) {
            const file = event.target.files[0];
            this.form.image = file;
            if (file && file.type.match("image.*")) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.imagePreviewUrl = e.target.result;
                };
                reader.readAsDataURL(file);
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
            this.form.reset(); // Resets the entire form
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
            imagePreviewUrl: null,
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

        #categories {
            width: 100%;
        }
    }

    .table-container {
        border-radius: var(--border-rad);
        overflow: hidden;

        table {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
        }

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
                    box-sizing: border-box;
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

    .image-preview-container {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        .image-preview {
            max-width: 30%;
            aspect-ratio: 3 / 4;
            object-fit: cover;
            margin-top: 10px; /* Adjust spacing as needed */
            border-radius: var(--border-rad);
        }
    }
}
</style>
