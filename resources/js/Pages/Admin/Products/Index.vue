<template>
    <Head title="Produkti" />

    <AdminLayout>
        <SystemMessage :message="systemMessage" :type="messageType" />
        <div class="container">
            <div class="option-container">
                <div class="option-container-left">
                    <div class="search-container">
                        <input
                            v-show="showSearch"
                            v-model="searchTerm"
                            type="text"
                            class="search-input"
                            @keyup.enter="performSearch"
                            :class="{ 'show-search': isSearchVisible }"
                        />

                        <BasicButton
                            class="search-button"
                            @click="toggleSearch"
                        >
                            <img src="@/Assets/search.svg" alt="search icon" />
                        </BasicButton>
                    </div>
                </div>

                <BasicButton
                    class="add-button"
                    @click="isAddProductModalOpen = true"
                >
                    <img src="@/Assets/plus.svg" alt="plus icon" />
                    Jauns
                </BasicButton>
                <FormModalLayout
                    v-model:showModal="isAddProductModalOpen"
                    @submit="addProduct"
                    @reset-form="resetForm"
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
                        <div class="image-category">
                            <div>
                                <InputLabel for="category"
                                    >Kategorijas:</InputLabel
                                >
                                <div class="categories-input">
                                    <div
                                        v-for="category in categories"
                                        :key="category.id"
                                        class="radio-tag"
                                    >
                                        <input
                                            type="radio"
                                            :id="'category-' + category.id"
                                            :value="category.id"
                                            v-model="form.category"
                                            name="category"
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
                                    :message="form.errors.category"
                                    class="mt-2"
                                />
                            </div>
                            <div class="images-input-box">
                                <InputLabel for="images">Attēli:</InputLabel>
                                <div class="images-input">
                                    <ImageUploadComponent
                                        :initial-image="initialImages[0]"
                                        :image-id="initialImagesId[0]"
                                        :index="0"
                                        @image-added="handleImageAdded"
                                        @image-removed="handleImageRemoved"
                                    />
                                    <ImageUploadComponent
                                        :initial-image="initialImages[1]"
                                        :image-id="initialImagesId[1]"
                                        :index="1"
                                        @image-added="handleImageAdded"
                                        @image-removed="handleImageRemoved"
                                    />
                                    <ImageUploadComponent
                                        :initial-image="initialImages[2]"
                                        :image-id="initialImagesId[2]"
                                        :index="2"
                                        @image-added="handleImageAdded"
                                        @image-removed="handleImageRemoved"
                                    />
                                </div>
                            </div>
                        </div>
                        <InputError :message="form.images.price" class="mt-2" />
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
                            <th>Nosaukums</th>
                            <th>Apraksts</th>
                            <th>Cena</th>
                            <th>Tips</th>
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
                                <div class="single-category">
                                    {{ product.category.name }}
                                </div>
                            </td>
                            <td>
                                <div class="product-image-field">
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
                                    src="@/Assets/pen.svg"
                                    alt="edit-icon"
                                    @click="editProduct(product)"
                                />
                                <img
                                    class="action-icon"
                                    src="@/Assets/trash.svg"
                                    alt="delete-icon"
                                    @click="deleteProduct(product)"
                                />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AdminLayout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
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
import { onMounted } from "vue";

export default {
    components: {
        AdminLayout,
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
    data() {
        return {
            isAddProductModalOpen: false,
            imagePreviewUrls: [],
            initialImages: [null, null, null],
            initialImagesId: [null, null, null],
            isEditMode: false,
            systemMessage: "",
            messageType: "info",
            showSearch: false,
            isSearchVisible: false,
            searchTerm: "",
        };
    },
    setup() {
        const form = useForm({
            id: null,
            title: "",
            description: "",
            price: null,
            category: "",
            images: [],
            removedImages: [],
        });

        return { form };
    },
    methods: {
        toggleSearch() {
            if (!this.showSearch) {
                this.showSearch = true;
                setTimeout(() => {
                    this.isSearchVisible = true;
                }, 1);
            } else {
                this.isSearchVisible = !this.isSearchVisible;
                setTimeout(() => {
                    this.showSearch = !this.showSearch;
                }, 300);
                this.performSearch();
            }
        },
        performSearch() {
            this.$inertia.get(
                route("products.index"),
                { search: this.searchTerm },
                {
                    preserveState: true,
                    preserveScroll: true,
                    replace: true,
                }
            );
            this.isSearchVisible = false;
            setTimeout(() => {
                this.showSearch = false;
            }, 300);
        },
        handleImageAdded(imageData) {
            console.log("Attempting to add image data:", imageData);
            this.form.images.push(imageData.file);
            console.log("Current form images after pushing:", this.form.images);
        },

        handleImageRemoved(imageData) {
            // If it's a newly added image (not saved), remove it from the array
            if (!imageData.id) {
                const index = this.form.images.indexOf(imageData.file);
                if (index !== -1) {
                    this.form.images.splice(index, 1);
                }
            } else {
                // If it's an existing image, mark it for removal
                this.form.removedImages.push(imageData.id);
            }
        },
        removeImage(imageData) {
            console.log("Attempting to remove image:", imageData);
            const { id, index } = imageData;

            if (index !== undefined) {
                console.log(
                    `Removing image at index ${index} from preview URLs.`
                );
                this.imagePreviewUrls.splice(index, 1);
                this.form.images.splice(index, 1);
            }

            if (id) {
                console.log(`Marking image with ID ${id} for deletion.`);
                this.form.removedImages.push(id);
            }
        },
        productImagePath(image) {
            const imagePath = image.image
                ? "/storage/" + image.image.replace("public/", "")
                : "resources/js/Assets/Images/Image1.png";
            return imagePath;
        },
        addProduct() {
            // Initialize FormData object
            let formData = new FormData();

            // Append form fields to formData
            Object.keys(this.form).forEach((key) => {
                if (key === "images" && this.form[key]) {
                    // Handle file inputs for 'images'
                    for (let i = 0; i < this.form.images.length; i++) {
                        formData.append(`images[${i}]`, this.form.images[i]);
                    }
                } else if (key === "removedImages" && this.form[key]) {
                    // Handle 'removedImages' as an array of IDs
                    this.form.removedImages.forEach((id, index) => {
                        formData.append(`removedImages[${index}]`, id);
                    });
                } else {
                    // Append other data normally
                    formData.append(key, this.form[key]);
                }
            });

            if (this.form.id) {
                formData.append("_method", "PATCH");
            }

            const url = this.form.id
                ? route("products.update", this.form.id)
                : route("products.store");

            // Use Inertia's post method for all requests, handling both create and update actions
            this.$inertia.post(url, formData, {
                onSuccess: () => {
                    this.isAddProductModalOpen = false;
                    this.setSystemMessage(
                        this.isEditMode
                            ? "Produkts atjaunināts veiksmīgi"
                            : "Produkts pievienots veiksmīgi",
                        "success"
                    );
                    this.resetForm();
                    this.isEditMode = false;
                },
                onError: (error) => {
                    console.error(
                        "There was an error updating the product: ",
                        error
                    );
                },
                forceFormData: true,
            });
        },
        resetForm() {
            this.form.reset();
            this.initialImages = [null, null, null];
            this.initialImagesId = [null, null, null];
            this.isEditMode = false;
            if (this.$refs.fileInput) {
                this.$refs.fileInput.value = null;
            }
            this.initialImage = null;
            this.initialImageId = null;
        },
        editProduct(product) {
            this.isEditMode = true;

            this.form.reset();
            this.form.id = product.id;
            this.form.title = product.title;
            this.form.description = product.description;
            this.form.price = product.price;
            this.form.category = product.category_id;

            // Preparing initial images for edit mode by directly using product images
            this.initialImages = product.images.map(
                (image) => "/storage/" + image.image.replace("public/", "")
            );
            this.initialImagesId = product.images.map((image) => image.id);

            while (this.initialImages.length < 3) {
                this.initialImages.push(null);
            }

            this.isAddProductModalOpen = true;
        },
        deleteProduct(product) {
            if (confirm(`Are you sure you want to delete ${product.title}?`)) {
                this.$inertia.delete(route("products.destroy", product.id), {
                    onSuccess: () => {
                        this.setSystemMessage(
                            "Produkts dzēsts veiksmīgi",
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
        align-items: center;

        .option-container-left {
            .search-container {
                display: flex;
            }

            .search-input {
                border-bottom: 2px solid var(--secondary);
                padding: 0.5rem 0;
                max-width: 0;
                transition: all 0.3s ease-in-out;
                opacity: 1;
                border-radius: var(--border-rad) 0 0 var(--border-rad);
                outline: 0;

                &:focus {
                    border-bottom: 2px solid var(--primary);
                }
            }

            .show-search {
                max-width: 10rem;
                padding: 0.5rem;
            }

            .search-button {
                border-radius: 0 var(--border-rad) var(--border-rad) 0;
            }
        }

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

                        .single-category {
                            width: fit-content;
                            padding: 0.1rem 0.4rem;
                            border: 1px solid var(--primary);
                            border-radius: var(--border-rad);
                        }
                        .product-image-field {
                            display: flex;
                            gap: 5px;
                            .product-image {
                                aspect-ratio: 3 / 4;
                                width: 3rem;
                                object-fit: cover;
                                display: block;
                                border-radius: var(--border-rad);
                            }
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
    .image-category {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;

        .images-input-box {
            .images-input {
                display: flex;
                flex-direction: row;
                justify-content: space-between;
            }
        }

        .categories-input {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;

            .radio-tag {
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
                        content: url(@/Assets/check.svg);
                        display: inline-block;
                        width: 0;
                        height: 100%;
                        margin-right: 0;
                        transition: all 0.5s;
                        transform: translate(0, 2px);
                    }
                }

                input[type="radio"] {
                    display: none;

                    &:checked + .tag-label {
                        background-color: var(--primary);
                        color: white;
                        text-align: center;

                        &::before {
                            content: url(@/Assets/check.svg);
                            display: inline-block;
                            width: 1rem;
                            height: 100%;
                            margin-right: 0.2rem;
                        }
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
