<template>
    <Head title="Produkti" />

    <AdminLayout>
        <SystemAlert :message="SystemAlert" :type="messageType" />

        <div class="container">
            <Modal v-if="isModalOpen" @close="closeModal" :showSidebar="true">
                <template #header><h2>Pievienot Produktu</h2></template>

                <template #content class="modal-content">
                    <!-- (input fields) -->
                    <div class="input-field">
                        <InputLabel for="title">Nosaukums:</InputLabel>
                        <input type="text" id="title" v-model="form.title" />
                        <InputError :message="form.errors.title" />
                    </div>
                    <div class="input-field">
                        <InputLabel for="description">Apraksts:</InputLabel>
                        <textarea
                            id="description"
                            v-model="form.description"
                        ></textarea>
                        <InputError :message="form.errors.description" />
                    </div>

                    <div class="images-input-box input-field">
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
                    <InputError :message="form.images.price" class="mt-2" />
                </template>

                <template #side-content>
                    <div class="input-field">
                        <InputLabel for="price">Cena:</InputLabel>
                        <input type="number" id="price" v-model="form.price" />
                        <InputError :message="form.errors.price" />
                    </div>
                    <div>
                        <InputLabel for="category">Kategorijas:</InputLabel>
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
                        <InputError :message="form.errors.category" />
                    </div>
                </template>

                <template #footer>
                    <div class="modal-footer">
                        <button
                            class="btn-secondary"
                            @click="
                                isModalOpen = false;
                                resetForm();
                            "
                        >
                            Atcelt
                        </button>
                        <button class="btn-primary" @click="addProduct">
                            Saglabāt
                        </button>
                    </div>
                </template>
            </Modal>
            <header class="header">
                <h1>Produkti</h1>
                <button class="add-button" @click="isModalOpen = true">
                    <img src="@/Assets/plus.svg" alt="plus icon" />
                    Pievienot
                </button>
            </header>
            <div class="main-content">
                <aside class="filters">
                    <h2>Filtrēšana</h2>
                    <div class="search-wrapper">
                        <input
                            v-show="showSearch"
                            v-model="searchTerm"
                            type="text"
                            class="search-input"
                            @keyup.enter="performSearch"
                            :class="{ 'show-search': isSearchVisible }"
                        />

                        <button class="search-button" @click="toggleSearch">
                            <img src="@/Assets/search.svg" alt="search icon" />
                        </button>
                    </div>

                    <div class="category-search-container">
                        <div @click="toggleDropdown" class="dropdown-button">
                            {{ selectedCategoryName || "Kategorijas" }}
                            <img src="@/Assets/arrow.svg" alt="arrow-icon" />
                        </div>
                        <div v-if="dropdownActive" class="dropdown-content">
                            <div
                                v-for="category in categories"
                                :key="category.id"
                                @click="selectCategory(category)"
                                class="dropdown-item"
                            >
                                {{ category.name }}
                            </div>
                        </div>
                    </div>
                </aside>

                <!-- Product table -->
                <div class="table-container">
                    <table cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th>Nosaukums</th>
                                <th class="hide-ssmall">raksts</th>
                                <th>Cena</th>
                                <th class="hide-ssmall">kategorija</th>
                                <th>Bilde</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="product in products" :key="product.id">
                                <td>
                                    {{ product.title }}
                                </td>
                                <td class="hide-ssmall">
                                    {{ product.description }}
                                </td>
                                <td>{{ product.price }}&euro;</td>
                                <td class="hide-ssmall">
                                    <div class="table-badge">
                                        {{ product.category.name }}
                                    </div>
                                </td>
                                <td>
                                    <div class="image-cell">
                                        <img
                                            v-if="product.images.length > 0"
                                            :src="
                                                productImagePath(
                                                    product.images[0]
                                                )
                                            "
                                            alt="Product Image"
                                            class="table-image"
                                        />
                                    </div>
                                </td>
                                <td>
                                    <img
                                        class="action-btn"
                                        src="@/Assets/pen.svg"
                                        alt="edit-icon"
                                        @click="editProduct(product)"
                                    />
                                    <img
                                        class="action-btn"
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
        </div>
    </AdminLayout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Modal from "@/Components/Modal.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import ImageUploadComponent from "@/Components/ImageUploadComponent.vue";
import SystemAlert from "@/Components/SystemAlert.vue";
import { Head } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";

export default {
    components: {
        AdminLayout,
        Head,
        Modal,
        InputError,
        InputLabel,
        ImageUploadComponent,
        SystemAlert,
    },
    props: {
        products: Array,
        categories: Array,
    },
    data() {
        return {
            isModalOpen: false,
            imagePreviewUrls: [],
            initialImages: [null, null, null],
            initialImagesId: [null, null, null],
            isEditMode: false,
            SystemAlert: "",
            messageType: "info",
            showSearch: false,
            isSearchVisible: false,
            searchTerm: "",
            dropdownActive: false,
            selectedCategory: null,
            selectedCategoryName: "",
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
        toggleDropdown() {
            this.dropdownActive = !this.dropdownActive;
        },
        selectCategory(category) {
            this.selectedCategory = category.id;
            this.selectedCategoryName = category.name;
            this.dropdownActive = false;
            this.filterByCategory();
        },
        filterByCategory() {
            // Logic to filter products by category
            this.performSearch();
        },
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
                {
                    search: this.searchTerm,
                    category: this.selectedCategory, // Pass the selected category ID
                },
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
                    this.isModalOpen = false;
                    this.setSystemAlert(
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
        closeModal() {
            this.isModalOpen = false;
            this.resetForm();
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

            this.resetForm();
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

            this.isModalOpen = true;
        },
        deleteProduct(product) {
            if (confirm(`Are you sure you want to delete ${product.title}?`)) {
                this.$inertia.delete(route("products.destroy", product.id), {
                    onSuccess: () => {
                        this.setSystemAlert(
                            "Produkts dzēsts veiksmīgi",
                            "success"
                        );
                    },
                    onError: (errors) => {
                        this.setSystemAlert(
                            "An error occurred while deleting the product",
                            "error"
                        );
                    },
                });
            }
        },
        setSystemAlert(message, type = "info") {
            this.SystemAlert = message;
            this.messageType = type;
        },
    },
};
</script>

<style lang="scss" scoped>
.container {
    display: flex;
    flex-direction: column;
    max-width: 95rem;
    margin: 0 auto;
    padding-inline: 0.5rem;

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 0;

        .add-button {
            width: fit-content;
            img {
                height: 1.2rem;
            }
        }
    }

    .main-content {
        display: grid;
        grid-template-columns: 300px 1fr;
        gap: 1rem;

        .filters {
            width: 100%;
            height: fit-content;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            border-radius: var(--rounded-box);
            border: 1px solid var(--color--secondary);
            padding: 4px;

            h2 {
                background-color: var(--color--secondary);
                font-size: 1.563rem;
                padding: 6px 8px;
            }

            .search-wrapper {
                display: flex;
                padding: 8px;

                .search-input {
                    border-bottom: 2px solid var(--color--secondary);
                    padding: 0.5rem 0;
                    max-width: 0;
                    transition: all 0.3s ease-in-out;
                    opacity: 1;
                    border-radius: var(--rounded-box) 0 0 var(--rounded-box);
                    outline: 0;

                    &:focus {
                        border-bottom: 2px solid var(--color--primary);
                    }
                }

                .show-search {
                    max-width: 100%;
                    padding: 0.5rem;
                }

                .search-button {
                    border-radius: 0 var(--rounded-box) var(--rounded-box) 0;
                }
            }

            .category-search-container {
                padding: 8px;
                position: relative;
                .dropdown-button {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    padding: 0.5rem 1rem;
                    background-color: var(--color--primary);
                    color: white;
                    border-radius: var(--rounded-box);
                    cursor: pointer;
                    height: 100%;

                    img {
                        height: 1.5rem;
                    }
                }

                .dropdown-content {
                    position: absolute;
                    top: 100%;
                    left: 0;
                    right: 0;
                    background-color: var(--color--secondary);
                    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
                    z-index: 100;
                    border-radius: 0 0 var(--rounded-box) var(--rounded-box);
                    z-index: 100;

                    .dropdown-item {
                        padding: 0.5rem 1rem;
                        cursor: pointer;
                        &:hover {
                            background-color: var(--color--light-primary);
                        }
                    }
                }
            }
        }

        .search-button {
            width: fit-content;
            img {
                height: 1.5rem;
            }
        }
    }

    .table-container {
        overflow: auto;
    }

    .images-input-box {
        width: 100%;
        .images-input {
            width: 100%;
            display: flex;
            flex-direction: row;
            gap: 1rem;
        }
    }

    .input-field {
        margin-bottom: 16px;
    }

    .modal-footer {
        display: flex;
        width: 100%;
        justify-content: space-between;
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
                background-color: var(--color--secondary);
                padding: 5px 10px;
                border-radius: var(--rounded-box);
                display: block;
                cursor: pointer;
                user-select: none;

                &:hover {
                    background-color: var(--color--secondary);
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
                    background-color: var(--color--primary);
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

    .hidden {
        display: none;
    }
}
</style>
