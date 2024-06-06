<template>
    <Head title="Panelis" />

    <MainLayout>
        <img
            class="brush-stroke-1"
            src="@/Assets/brush-strokes/brush-stroke-2.svg"
        />
        <img
            class="brush-stroke-2"
            src="@/Assets/brush-strokes/brush-stroke-3.svg"
        />
        <div class="about-container">
            <div class="inner-container">
                <div class="about-text">
                    <h2>Par Arti Daugatu</h2>
                    <div class="text-seperator"></div>
                    <p>
                        Lorem ipsum dolor sit amet consectetur, adipisicing
                        elit. Fuga, repudiandae eum nihil earum, omnis aperiam
                        animi corporis, perspiciatis in provident inventore vel
                        iste cum
                    </p>
                    <p>
                        voluptates corrupti amet fugit atque harum excepturi!
                        Sapiente iste, eius maxime quas eligendi fuga! Corporis
                        eaque repellendus odio voluptatem blanditiis ipsum ad
                        commodi nemo quis. Sapiente.
                    </p>
                </div>
                <div class="about-image">
                    <img src="@/Assets/Images/artis-port-masked.svg" alt="" />
                </div>
            </div>
        </div>

        <form class="form-container" @submit.prevent="submit" id="contact-form">
            <h3>Sazinies</h3>
            <div class="input-grid">
                <div class="name-input">
                    <InputError :message="form.errors.name" class="mt-2" />
                    <input
                        type="text"
                        v-model="form.name"
                        placeholder="Jūsu Vārds"
                        autocomplete="name"
                    />
                </div>
                <div class="email-input">
                    <InputError :message="form.errors.email" class="mt-2" />
                    <input
                        type="email"
                        v-model="form.email"
                        placeholder="Jūsu Epasts"
                        autocomplete="email"
                    />
                </div>

                <textarea
                    v-model="form.message"
                    class="message-input"
                    :rows="3"
                    placeholder="Ievadiet Savu Ziņu"
                ></textarea>
            </div>
            <div
                id="recaptcha-container"
                class="g-recaptcha"
                :data-sitekey="recaptchaSiteKey"
            ></div>
            <button class="w-full btn-primary" type="submit">Nosutīt</button>
        </form>
    </MainLayout>
</template>

<script setup>
import { onMounted } from "vue";
import MainLayout from "@/Layouts/MainLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";

const form = useForm({
    name: "",
    email: "",
    message: "",
    "g-recaptcha-response": "",
});

const recaptchaSiteKey = import.meta.env.VITE_RECAPTCHA_SITE_KEY;

const submit = () => {
    grecaptcha.ready(() => {
        grecaptcha
            .execute(recaptchaSiteKey, { action: "submit" })
            .then((token) => {
                form["g-recaptcha-response"] = token;
                form.post("/send-message", {
                    onSuccess: () => {
                        form.reset();
                        grecaptcha.reset();
                    },
                    onError: () => {
                        grecaptcha.reset();
                    },
                });
            });
    });
};

// Make the callback function globally accessible
window.recaptchaCallback = function (token) {
    form["g-recaptcha-response"] = token;
};

onMounted(() => {
    if (window.grecaptcha) {
        grecaptcha.render("recaptcha-container", {
            sitekey: recaptchaSiteKey,
            callback: window.recaptchaCallback, // Ensure callback is globally accessible
        });
    }
});
</script>

<style lang="scss" scoped>
.brush-stroke-1 {
    position: absolute;
    width: 16vw;
    min-width: 150px;
    left: -30px;
    top: 560px;
    z-index: 50;
    -webkit-transform: scaleY(-1);
    transform: scaleY(-1);
}

.brush-stroke-2 {
    position: absolute;
    width: 6vw;

    right: 30px;
    top: -120px;
    z-index: 50;
    -webkit-transform: scalex(-1);
    transform: scalex(-1);
    transform: rotate(5deg);
}

.hero-image {
    width: 100%;
    height: 40rem;
    overflow: hidden;
    img {
        object-fit: cover;
        width: 100%;
        height: 100%;
    }
}

.about-container {
    display: flex;
    background-image: linear-gradient(
        90deg,
        var(--color--white) 0%,
        var(--color--white) 50%,
        var(--color--secondary) 50%,
        var(--color--secondary) 100%
    );
    width: 100%;
    display: flex;
    justify-content: center;

    @media (max-width: 768px) {
        align-items: center;
        flex-direction: column;
        background-image: linear-gradient(
            0deg,
            var(--color--white) 0%,
            var(--color--white) 50%,
            var(--color--secondary) 50%,
            var(--color--secondary) 100%
        );
    }
    @media (max-width: 568px) {
        display: flex;
        align-items: center;
        flex-direction: column;
    }

    .inner-container {
        display: flex;
        justify-content: space-between;
        width: 100%;
        max-width: 95rem;

        @media (max-width: 768px) {
            align-items: center;
            flex-direction: column-reverse;
        }
        @media (max-width: 568px) {
            display: flex;
            align-items: center;
            flex-direction: column-reverse;
        }

        .about-text {
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: left;
            text-align: left;
            gap: 16px;
            padding: 96px;

            .text-seperator {
                height: 2px;
                background-color: var(--color--primary);
                width: 80px;
            }

            p {
                text-align: left;
                font-size: 20px;
            }
        }
        .about-image {
            width: 100%;
            padding: 96px;
            aspect-ratio: 1/1;
            display: flex;
            justify-content: center;
            align-items: center;

            img {
                width: 100%;
                aspect-ratio: 1 / 1;
                border-radius: 50%;
                display: flex;
                justify-content: center;
                align-items: center;
                filter: hue-rotate(15deg);
            }
        }
    }
}

.form-container {
    width: 50%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 2rem 0;

    h2 {
        text-align: center;
    }

    .input-grid {
        display: grid;
        width: 100%;
        grid-template-columns: repeat(2, 1fr);
        grid-template-rows: 1fr 3fr;
        grid-column-gap: 1rem;
        grid-row-gap: 1rem;
        margin-bottom: 1rem;
    }

    .name-input {
        grid-area: 1 / 1 / 2 / 2;
    }
    .email-input {
        grid-area: 1 / 2 / 2 / 3;
    }
    .message-input {
        grid-area: 2 / 1 / 3 / 3;
    }
}
</style>
