<template>
    <Head title="Users" />

    <AdminLayout>
        <SystemAlert :message="SystemAlert" :type="messageType" />
        <div class="container">
            <div class="option-container">
                <div class="container-heading">
                    <h1>Produkti</h1>
                    <div></div>
                </div>
                <div class="container-filters">
                    <div class="search-container">
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

                    <div></div>
                </div>
                <div class="option-container-left"></div>

                <FormModalLayout
                    v-model:showModal="isAddModalOpen"
                    @submit="addUser"
                    @reset-form="resetForm"
                >
                    <template #header><h2>Pievienot Produktu</h2></template>

                    <template #body class="modal-content">
                        <!-- (input fields) -->
                        <div>
                            <InputLabel for="name">Vārds:</InputLabel>
                            <input type="text" id="name" v-model="form.name" />
                            <InputError
                                :message="form.errors.name"
                                class="mt-2"
                            />
                        </div>
                        <div>
                            <InputLabel for="email">Epasts:</InputLabel>
                            <input
                                type="email"
                                id="email"
                                v-model="form.email"
                            />
                            <InputError
                                :message="form.errors.email"
                                class="mt-2"
                            />
                        </div>
                        <div>
                            <InputLabel for="role">Loma:</InputLabel>
                            <div class="roles-input">
                                <div
                                    v-for="role in roles"
                                    :key="role.id"
                                    class="radio-tag"
                                >
                                    <input
                                        type="radio"
                                        :id="'role-' + role.id"
                                        :value="role.id"
                                        v-model="form.role"
                                    />
                                    <label
                                        :for="'role-' + role.id"
                                        class="tag-label"
                                    >
                                        {{ role.name }}
                                    </label>
                                </div>
                            </div>
                            <InputError
                                :message="form.errors.role"
                                class="mt-2"
                            />
                        </div>
                    </template>

                    <template #footer>
                        <!-- Modal footer content -->
                        <button
                            class="cancel-btn"
                            @click="
                                isAddModalOpen = false;
                                resetForm();
                            "
                        >
                            Atcelt
                        </button>
                        <button class="submit-btn" @click="addUser">
                            Saglabāt
                        </button>
                    </template>
                </FormModalLayout>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Vārds</th>
                            <th class="hide-ssmall">Epasts</th>
                            <th>Loma</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in users" :key="user.id">
                            <td>{{ user.id }}</td>
                            <td>{{ user.name }}</td>
                            <td class="hide-ssmall">{{ user.email }}</td>
                            <td>
                                <div class="table-badge">
                                    {{ user.role.name }}
                                </div>
                            </td>
                            <td>
                                <img
                                    class="action-btn"
                                    src="@/Assets/pen.svg"
                                    alt="edit-icon"
                                    @click="editUser(user)"
                                />
                                <img
                                    class="action-btn"
                                    src="@/Assets/trash.svg"
                                    alt="delete-icon"
                                    @click="deleteUser(user)"
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
import FormModalLayout from "@/Layouts/FormModalLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import SystemAlert from "@/Components/SystemAlert.vue";
import { Head } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";

export default {
    components: {
        AdminLayout,
        Head,
        FormModalLayout,
        InputError,
        InputLabel,
        SystemAlert,
    },
    props: {
        users: Array,
        roles: Array,
    },
    data() {
        return {
            isAddModalOpen: false,
            isEditMode: false,
            SystemAlert: "",
            messageType: "info",
            showSearch: false,
            isSearchVisible: false,
            searchTerm: "",
        };
    },
    setup() {
        const form = useForm({
            id: null,
            name: "",
            email: "",
            role: "",
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
                route("users.index"),
                {
                    search: this.searchTerm,
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
        addUser() {
            const method = this.form.id ? "patch" : "post";
            const url = this.form.id
                ? route("users.update", this.form.id)
                : route("users.store");

            console.log(this.form);

            this.form[method](url, {
                onSuccess: () => {
                    this.isAddModalOpen = false;
                    this.setSystemAlert(
                        this.isEditMode
                            ? "Lietotājs veiksmīgi rediģēts"
                            : "Lietotājs veiksmīgi pievienots",
                        "success"
                    );
                    this.resetForm();
                },
                onError: (error) => {
                    console.error("There was an error:", error);
                },
            });
        },
        resetForm() {
            this.form.reset();
            this.isEditMode = false;
        },
        editUser(user) {
            this.isEditMode = true;

            this.form.reset();
            this.form.id = user.id;
            this.form.name = user.name;
            this.form.email = user.email;
            this.form.role = user.role.id;

            this.isAddModalOpen = true;
        },
        deleteUser(user) {
            if (confirm(`Are you sure you want to delete ${user.name}?`)) {
                this.$inertia.delete(route("users.destroy", user.id), {
                    onSuccess: () => {
                        this.setSystemAlert(
                            "Lietotājs dzēsts veiksmīgi",
                            "success"
                        );
                    },
                    onError: (errors) => {
                        this.setSystemAlert(
                            "An error occurred while deleting the user",
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
    max-width: 95rem;
    padding: 1rem 0.5rem;
    display: flex;
    flex-direction: column;
    gap: 1rem;

    .option-container {
        max-width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;

        .container-heading {
            width: 100%;
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid var(--color--primary);
            margin: 8px 0;

            h1 {
                width: 100%;
                font-size: 3rem;
            }
        }

        .container-filters {
            width: 100%;
            display: flex;
            justify-content: space-between;

            .search-container {
                display: flex;

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
                    max-width: 10rem;
                    padding: 0.5rem;
                }

                .search-button {
                    border-radius: 0 var(--rounded-box) var(--rounded-box) 0;
                }
            }

            .category-search-container {
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

        .add-button,
        .search-button {
            width: fit-content;
            img {
                height: 1.5rem;
            }
        }
    }

    .table-container {
        border-radius: var(--rounded-box);
        overflow: hidden;
    }

    .roles-input {
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
