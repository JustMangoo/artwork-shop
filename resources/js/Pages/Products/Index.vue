<template>
    <Head title="Produkti" />

    <MainLayout>
        <div class="mx-auto max-w-[90rem] sm:px-6 lg:px-8">
            <!-- ... -->

            <!-- Product table -->
            <div
                class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg"
            >
                <table class="w-full table-auto">
                    <thead class="border-b border-gray-600">
                        <tr>
                            <!-- Adjust columns as needed -->
                            <th class="p-3 text-left text-white">
                                Product Title
                            </th>
                            <th class="p-3 text-left text-white">Price</th>
                            <th class="p-3 text-left text-white">Category</th>
                            <!-- Add more columns as necessary -->
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Loop through products -->
                        <tr v-for="product in products" :key="product.id">
                            <td class="px-4 py-2 text-white">
                                {{ product.title }}
                            </td>
                            <td class="px-4 py-2 text-white">
                                {{ product.price }}
                            </td>
                            <td class="px-4 py-2 text-white">
                                {{ product.category.name }}
                            </td>
                            <!-- Output more product details as needed -->
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- ... -->
        </div>
    </MainLayout>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import { Head } from "@inertiajs/vue3";

export default {
    components: {
        MainLayout,
        Head,
    },
    props: {
        products: Array, // Make sure to pass this prop from your Laravel controller
        // ... other props ...
    },
    data() {
        return {
            // ... your data properties ...
        };
    },
    methods: {
        // ... your methods ...
    },
};
</script>

<style lang="scss" scoped></style>
