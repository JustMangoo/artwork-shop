<template>
    <SystemMessage :message="systemMessage" :type="messageType" />
    <footer>
        <!-- Copyright -->
        <p class="copyright">© 2024 Aleksis Daugats</p>
    </footer>
</template>

<script>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import SystemMessage from "@/Components/SystemMessage.vue";

export default {
    components: {
        InputError,
        PrimaryButton,
        TextInput,
        SystemMessage,
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
                        this.setSystemMessage(
                            "Abonaments veiksmīgs",
                            "success"
                        );
                        this.form.email = "";
                        this.form.errors = {};
                    },
                    onError: (errors) => {
                        this.setSystemMessage(
                            "Abonaments nav izdevies",
                            "error"
                        );
                        this.form.errors = errors;
                    },
                    onFinish: () => (this.form.processing = false),
                }
            );
        },

        setSystemMessage(message, type = "info") {
            this.systemMessage = message;
            this.messageType = type;
        },
    },
    data() {
        return {
            systemMessage: "",
            messageType: "info",
        };
    },
};
</script>

<style lang="scss">
footer {
    background-color: var(--secondary);
    padding: 2rem 0;
    color: var(--neutral-two);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 100%;
    overflow: hidden;

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
        width: 100%;
        h3 {
            width: 100%;

            @media (max-width: 768px) {
                text-align: center;
            }
        }
    }

    .socials {
        width: 100%;
        h3 {
            text-align: center;
        }
    }
    .form-container {
        width: 100%;
        form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-top: 0.4rem;
            width: 100%;
            .input-email {
                width: 100%;
            }
            .form-button {
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
                    background-color: var(--primary);
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
