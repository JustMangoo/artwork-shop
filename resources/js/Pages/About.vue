<template>
    <Head title="Panelis" />

    <MainLayout>
        <div class="hero-image">
            <img src="@\Assets\Images\Image1.png" alt="hero image" />
        </div>
        <div class="about-container">
            <div class="about-text">
                <h1>Par Arti Daugatu</h1>
                <p>
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                    Fuga, repudiandae eum nihil earum, omnis aperiam animi
                    corporis, perspiciatis in provident inventore vel iste cum
                </p>
                <p>
                    voluptates corrupti amet fugit atque harum excepturi!
                    Sapiente iste, eius maxime quas eligendi fuga! Corporis
                    eaque repellendus odio voluptatem blanditiis ipsum ad
                    commodi nemo quis. Sapiente.
                </p>
            </div>
            <div class="about-image">
                <img src="@/Assets/Images/Artis-port.jpg" alt="" />
            </div>
        </div>

        <form class="form-container" @submit.prevent="submit" id="contact-form">
            <h2>Sazinies</h2>
            <div class="input-grid">
                <div class="name-input">
                    <InputError :message="form.errors.name" class="mt-2" />
                    <TextInput
                        v-model="form.name"
                        placeholder="Jūsu Vārds"
                        autocomplete="name"
                    />
                </div>
                <div class="email-input">
                    <InputError :message="form.errors.email" class="mt-2" />
                    <TextInput
                        v-model="form.email"
                        placeholder="Jūsu Epasts"
                        autocomplete="email"
                    />
                </div>

                <TextArea
                    v-model="form.message"
                    class="message-input"
                    :rows="3"
                    placeholder="Ievadiet Savu Ziņu"
                ></TextArea>
            </div>
            <PrimaryButton type="submit">Nosutīt</PrimaryButton>
        </form>
    </MainLayout>
</template>

<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import TextArea from "@/Components/TextArea.vue";
import InputError from "@/Components/InputError.vue";

const form = useForm({
    name: "",
    email: "",
    message: "",
});

const submit = () => {
    form.reset();
    form.post("/send-message");
};
</script>

<style lang="scss" scoped>
.hero-image {
    width: 100%;
    height: 40rem;
    overflow: auto;
    img {
        object-fit: cover;
        width: 100%;
        height: 100%;
    }
}

.about-container {
    display: flex;
    max-width: 95rem;
    padding: 4rem 1rem;
    justify-content: space-around;

    @media (max-width: 768px) {
        align-items: center;
        flex-direction: column;
    }
    @media (max-width: 568px) {
        display: flex;
        align-items: center;
        flex-direction: column;
    }

    .about-text {
        max-width: 30%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        @media (max-width: 768px) {
            max-width: 70%;
        }

        p {
            text-align: center;
            font-size: 20px;
            padding-bottom: 1rem;
        }
    }
    .about-image {
        max-width: 40%;
        padding: 0 4rem;
        @media (max-width: 768px) {
            max-width: 100%;
        }
        background: url("@/Assets/brush-strokes/brush-stroke-1.svg");
        background-repeat: no-repeat;
        background-position: center;
        background-size: contain;
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

.form-container {
    width: 50%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding-bottom: 2rem;

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
