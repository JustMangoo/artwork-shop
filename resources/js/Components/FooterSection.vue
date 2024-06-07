<template>
    <footer>
        <div class="container">
            <!-- Form Section -->
            <div class="form-container">
                <h4>Jaunumi</h4>
                <form @submit.prevent="submitForm">
                    <div class="input-email">
                        <input
                            type="email"
                            id="email"
                            v-model="form.email"
                            required
                            autocomplete="email"
                            placeholder="Ievadiet Epastu"
                        />

                        <InputError :message="form.errors.email" />
                    </div>
                    <div class="newsletter-btn">
                        <button
                            class="w-full btn-primary"
                            :disabled="form.processing"
                        >
                            Abonēt
                        </button>
                    </div>
                </form>
            </div>

            <!-- Contact Information Section -->
            <div class="contacts">
                <h4>Kontakti</h4>
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
                <h4>Citi resursi</h4>
                <div class="info">
                    <p>Privātuma politika</p>
                    <a href="/about">Par mani</a>
                    <a href="/about#contact-form">Sazinies</a>
                </div>
            </div>

            <!-- Social Media Links Section -->
            <div class="socials">
                <h4>Sociālie tīkli</h4>
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

<script>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";

export default {
    components: {
        InputError,
    },
    setup() {
        const form = useForm({
            email: "",
        });

        return { form };
    },
    methods: {
        submitForm() {
            this.form.processing = true;
            this.$inertia.post(
                "/subscribe",
                {
                    email: this.form.email,
                },
                {
                    preserveState: true,
                    onSuccess: () => {
                        this.form.email = "";
                        this.form.errors = {};
                    },
                    onError: (errors) => {
                        this.form.errors = errors;
                    },
                    onFinish: () => (this.form.processing = false),
                }
            );
        },
    },
    data() {
        return {
            messageType: "info",
        };
    },
};
</script>

<style lang="scss" scoped>
footer {
    background-color: var(--color--secondary);
    padding: 2rem 0;
    color: var(--color--dark);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 100%;
    overflow: hidden;

    .container {
        width: 100%;
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
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;

        h4 {
            margin-bottom: 1rem;
            @media (max-width: 768px) {
                text-align: center;
            }
        }
    }

    .socials {
        width: 100%;

        h4 {
            margin-bottom: 0.5rem;
            text-align: center;
        }
    }
    .form-container {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-top: 0.4rem;
            width: 100%;
            .input-email {
                width: 100%;
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

            p,
            a {
                display: grid;
                grid-template-columns: 1fr auto 1fr;
                align-items: center;
                gap: 5px; /* Space between the lines and the text */

                &::before {
                    content: "";
                    width: 5px; /* Fixed width of the line */
                    height: 1px; /* Thickness of the line */
                    background-color: var(--color--primary);
                    justify-self: center;
                    transition: all 0.3s ease-in-out;
                }

                &:hover::before {
                    width: 10px; /* Fixed width of the line */
                }
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
        gap: 8px;

        .links {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            gap: 2rem;

            a {
                width: 2.6rem;
                height: 2.6rem;
                background-color: var(--color--primary);
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
