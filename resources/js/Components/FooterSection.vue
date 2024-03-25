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
                            placeholder="Jūsu ziņa"
                        ></TextArea>

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
                        <img src="../Assets/mail.svg" alt="" />
                        Example@example.com
                    </p>
                    <p>
                        <img src="../Assets/phone.svg" alt="" />
                        123-456-7890
                    </p>
                    <p>
                        <img src="../Assets/location.svg" alt="" />
                        123 Vue Street, JavaScript City
                    </p>
                </div>
            </div>

            <div class="recources">
                <h3>Citi Resursi</h3>
                <div class="info">
                    <p>Privātuma politika</p>
                    <p>Par mani</p>
                </div>
            </div>

            <!-- Social Media Links Section -->
            <div class="socials">
                <h3>Sociālie tīkli</h3>
                <div class="links">
                    <a
                        class="icon"
                        href="https://instagram.com"
                        target="_blank"
                    >
                        <img src="../Assets/socials/instagram.svg" alt="" />
                    </a>
                    <a class="icon" href="https://tiktok.com" target="_blank">
                        <img src="../Assets/socials/tiktok.svg" alt="" />
                    </a>
                    <a class="icon" href="https://facebook.com" target="_blank">
                        <img src="../Assets/socials/facebook.svg" alt="" />
                    </a>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <p class="copyright">© 2024 Aleksis Daugats</p>
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
.recources {
    grid-area: recources;
}
.socials {
    grid-area: socials;
}

footer {
    background-color: var(--secondary);
    padding: 2rem 0;
    color: var(--neutral-two);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 100%;

    .container {
        max-width: 95rem;
        padding-inline: 0.5rem;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-template-rows: repeat(2, 0.7fr);
        grid-column-gap: 2rem;
        grid-row-gap: 2rem;

        .form-container {
            grid-area: 1 / 1 / 2 / 2;
        }
        .recources {
            grid-area: 1 / 2 / 2 / 3;
        }
        .contacts {
            grid-area: 1 / 3 / 2 / 4;
        }
        .socials {
            grid-area: 2 / 1 / 3 / 4;
        }

        @media (max-width: 1200px) {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-template-rows: repeat(3, 0.5fr);
            grid-column-gap: 2rem;
            grid-row-gap: 2rem;

            .form-container {
                grid-area: 2 / 1 / 3 / 3;
            }
            .recources {
                grid-area: 1 / 1 / 2 / 2;
            }
            .contacts {
                grid-area: 1 / 2 / 2 / 3;
            }
            .socials {
                grid-area: 3 / 1 / 4 / 3;
            }
        }
        @media (max-width: 768px) {
            display: grid;
            grid-template-columns: 1fr;
            grid-template-rows: repeat(4, 1fr);
            grid-column-gap: 2rem;
            grid-row-gap: 2rem;

            .form-container {
                grid-area: 1 / 1 / 2 / 2;
            }
            .recources {
                grid-area: 2 / 1 / 3 / 2;
            }
            .contacts {
                grid-area: 3 / 1 / 4 / 2;
            }
            .socials {
                grid-area: 4 / 1 / 5 / 2;
            }
        }
    }
    .form-container,
    .recources,
    .contacts {
        h3 {
            width: 100%;

            @media (max-width: 1200px) {
            }
            @media (max-width: 768px) {
                text-align: center;
            }
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
            gap: 1rem;

            p {
                display: flex;
                flex-direction: row;
                justify-content: center;
                align-items: center;
                user-select: text;

                img {
                    height: 1.2rem;
                    margin-right: 0.5rem;
                }
            }
        }
    }

    .recources {
        display: flex;
        flex-direction: column;
        justify-content: baseline;
        align-items: flex-start;

        .info {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 1rem;

            p {
                display: flex;
                flex-direction: row;
                justify-content: center;
                align-items: center;
                user-select: text;

                img {
                    height: 1.2rem;
                    margin-right: 0.5rem;
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

                img {
                    height: 100%;
                    padding: 0.5rem;
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
