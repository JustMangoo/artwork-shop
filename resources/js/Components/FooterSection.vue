<template>
    <footer>
        <div class="container">
            <!-- Form Section -->
            <div class="form-container">
                <h3>Sazinies</h3>
                <form @submit.prevent="submitForm">
                    <div class="input-name">
                        <TextInput
                            id="name"
                            v-model="form.name"
                            required
                            autocomplete="given-name"
                            rows="20"
                            placeholder="Vārds"
                        />

                        <InputError class="mt-2" :name="form.errors.name" />
                    </div>
                    <div class="input-email">
                        <TextInput
                            id="email"
                            v-model="form.email"
                            required
                            autocomplete="email"
                            rows="20"
                            placeholder="Epasts"
                        />

                        <InputError class="mt-2" :email="form.errors.email" />
                    </div>
                    <div class="input-message">
                        <TextArea
                            id="message"
                            v-model="form.message"
                            required
                            autocomplete="off"
                            rows="20"
                            placeholder="Jūsu ziņa"
                        />

                        <InputError
                            class="mt-2"
                            :message="form.errors.message"
                        />
                    </div>
                    <PrimaryButton
                        class="form-button"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Nosūtīt
                    </PrimaryButton>
                </form>
            </div>

            <!-- Contact Information Section -->
            <div class="contacts">
                <h3>Kontakti</h3>
                <div class="info">
                    <p>
                        <ion-icon name="mail-outline"></ion-icon>
                        Example@example.com
                    </p>
                    <p>
                        <ion-icon name="call-outline"></ion-icon>
                        123-456-7890
                    </p>
                    <p>
                        <ion-icon name="location-outline"></ion-icon>
                        123 Vue Street, JavaScript City
                    </p>
                </div>
            </div>

            <!-- Social Media Links Section -->
            <div class="socials">
                <h3>Sociālie tīkli</h3>
                <div class="links">
                    <a class="icon" href="https://instagram.com" target="_blank"
                        ><ion-icon name="logo-instagram"></ion-icon
                    ></a>
                    <a class="icon" href="https://tiktok.com" target="_blank"
                        ><ion-icon name="logo-tiktok"></ion-icon
                    ></a>
                    <a class="icon" href="https://facebook.com" target="_blank"
                        ><ion-icon name="logo-facebook"></ion-icon
                    ></a>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <p class="copyright">© 2023 Aleksis Daugats</p>
    </footer>
</template>

<script setup>
import { Link, useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import TextArea from "@/Components/TextInput.vue";

function submitForm() {
    console.log("Form submitted:", form);
    form.name = "";
    form.email = "";
    form.message = "";
}

const form = useForm({
    name: "",
    email: "",
    message: "",
});
</script>

<style lang="scss">
.form-container {
    grid-area: form;
}
.contacts {
    grid-area: contacts;
}
.socials {
    grid-area: socials;
}

footer {
    background-color: var(--secondary);
    padding: 2rem 0;
    color: #333;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 100%;

    .container {
        max-width: 90rem;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-template-rows: 1fr 0.5fr;
        grid-column-gap: 2rem;
        grid-row-gap: 2rem;

        .form-container {
            grid-area: 1 / 1 / 2 / 2;
        }
        .contacts {
            grid-area: 1 / 2 / 2 / 3;
        }
        .socials {
            grid-area: 2 / 1 / 3 / 3;
        }

        @media (min-width: 640px) {
            padding: 0 1.5rem;
        }

        @media (min-width: 1024px) {
            padding: 0 2rem;
        }
    }
    .form-container,
    .contacts {
        h3 {
            width: 100%;
        }
    }

    .socials {
        h3 {
            text-align: center;
            width: 100%;
        }
    }
    .form-container {
        border-radius: 5px;

        form {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-template-rows: repeat(3, 1fr);
            grid-column-gap: 1rem;
            grid-row-gap: 1rem;

            .input-name {
                grid-area: 1 / 1 / 2 / 2;
            }
            .input-email {
                grid-area: 1 / 2 / 2 / 3;
            }
            .input-message {
                grid-area: 2 / 1 / 3 / 3;
            }
            .form-button {
                grid-area: 3 / 1 / 4 / 3;
            }
        }
    }

    .contacts {
        display: flex;
        flex-direction: column;
        justify-content: baseline;
        align-items: flex-start;

        .info {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 2rem;

            p {
                display: flex;
                flex-direction: row;
                justify-content: center;
                align-items: center;
                user-select: text;

                ion-icon {
                    font-size: 1.6rem;
                    color: var(--primary);
                    margin-right: 0.6rem;
                }
            }
        }
    }

    .socials {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;

        .links {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            gap: 2rem;

            a {
                width: 2.6rem;
                height: 2.6rem;
                background-color: var(--primary);
                border-radius: 50%;

                ion-icon {
                    font-size: 1.6rem;
                    color: var(--neutral-two);
                }
            }

            a:hover {
                transform: scale(1.1);
            }
        }
    }

    .copyright {
        font-size: 0.9rem;
    }
}
</style>
