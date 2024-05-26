<template>
    <Head title="Users" />

    <AdminLayout>
        <SystemAlert :message="SystemAlert" :type="messageType" />

        <div class="container">
            <Modal
                v-if="isModalOpen"
                @close="isModalOpen = false"
                :showSidebar="true"
            >
                <template #header
                    ><h2>
                        {{
                            isEditMode
                                ? "Rediģēt Lietotāju"
                                : "Pievienot Lietotāju"
                        }}
                    </h2>
                </template>

                <template #content class="modal-content">
                    <div class="input-field">
                        <InputLabel for="name">Vārds:</InputLabel>
                        <input type="text" id="name" v-model="form.name" />
                        <InputError :message="form.errors.name" />
                    </div>
                    <div class="input-field">
                        <InputLabel for="email">Epasts:</InputLabel>
                        <input type="email" id="email" v-model="form.email" />
                        <InputError :message="form.errors.email" />
                    </div>
                </template>

                <template #side-content>
                    <div class="roles-input">
                        <InputLabel for="role">Loma:</InputLabel>
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
                            <label :for="'role-' + role.id" class="tag-label">{{
                                role.name
                            }}</label>
                        </div>
                    </div>
                </template>

                <template #footer>
                    <div class="modal-footer">
                        <button
                            class="btn-secondary"
                            @click="isModalOpen = false"
                        >
                            Atcelt
                        </button>
                        <button class="btn-primary" @click="submitForm">
                            Saglabāt
                        </button>
                    </div>
                </template>
            </Modal>

            <header class="header">
                <h1>Lietotāji</h1>
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
                </aside>

                <div class="table-container">
                    <table cellspacing="0" cellpadding="0">
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
        </div>
    </AdminLayout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Modal from "@/Components/Modal.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
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
        SystemAlert,
    },
    props: {
        users: Array,
        roles: Array,
    },
    data() {
        return {
            isModalOpen: false,
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
        submitForm() {
            const method = this.form.id ? "patch" : "post";
            const url = this.form.id
                ? route("users.update", this.form.id)
                : route("users.store");

            console.log(this.form);

            this.form[method](url, {
                onSuccess: () => {
                    this.isModalOpen = false;
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

            this.isModalOpen = true;
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
.container {
    display: flex;
    flex-direction: column;
    max-width: 95rem;
    margin: 0 auto;
    padding-inline: 0.5rem;

    .input-field {
        margin-bottom: 16px;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 0;
    }
    .modal-footer {
        display: flex;
        width: 100%;
        justify-content: space-between;
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
    }

    .hidden {
        display: none;
    }
}
</style>
