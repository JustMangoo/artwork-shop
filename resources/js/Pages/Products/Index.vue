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
                            <TextInput id="title" v-model="newProduct.title" />
                        </div>
                        <div>
                            <InputLabel for="description">Apraksts:</InputLabel>
                            <TextArea
                                id="description"
                                v-model="newProduct.description"
                            ></TextArea>
                        </div>
                        <div>
                            <InputLabel for="price">Cena:</InputLabel>
                            <TextInput
                                id="price"
                                type="number"
                                v-model.number="newProduct.price"
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
                                        v-model="newProduct.categories"
                                    />
                                    <label
                                        :for="'category-' + category.id"
                                        class="tag-label"
                                    >
                                        {{ category.name }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </template>

                    <template #footer>
                        <!-- Modal footer content -->
                        <BasicButton
                            class="cancel-btn"
                            @click="isAddProductModalOpen = false"
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
                            <td>
                                {{ product.price }}
                            </td>
                            <td>
                                <ul>
                                    <li
                                        v-for="category in product.categories"
                                        :key="category.id"
                                    >
                                        {{ category.name }}<br />
                                    </li>
                                </ul>
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
    data() {
        return {
            isAddProductModalOpen: false,
            newProduct: {
                title: "",
                description: "",
                price: null,
                categories: [],
            },
        };
    },
    methods: {
        addProduct() {
            // Ensure you are calling the correct endpoint and passing the necessary data
            this.$inertia.post("/products", {
                ...this.newProduct,
                // Assuming 'categories' needs to be an array of category IDs
                categories: [
                    /* Category IDs here */
                ],
            });

            // After submitting, reset the newProduct data and close the modal
            this.resetForm();
            this.isAddProductModalOpen = false;
        },
        resetForm() {
            this.newProduct = { title: "", description: "", price: null };
            // Reset other fields as necessary
        },
    },
};
</script>

<style lang="scss" scoped>
.container {
    max-width: 95rem;
    padding-inline: 0.5rem;
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
        border-radius: 2px;
        overflow: hidden;

        table {
            width: 100%;
            table-layout: auto;
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

                td {
                    color: var(--neutral-two);
                    padding: 0.5rem;
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
                border-radius: 15px;
                display: block;
                cursor: pointer;
                user-select: none;

                &:hover {
                    background-color: var(--secondary);
                }
            }

            input[type="checkbox"] {
                display: none;

                &:checked + .tag-label {
                    background-color: var(--primary);
                    color: white;
                }
            }
        }
    }
}
</style>
