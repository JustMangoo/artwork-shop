<template>
    <Head title="Sveicināti" />

    <MainLayout>
        <CarouselHero>
            <template v-slot="{ index }">
                <img :src="`../Assets/Images/Image${index + 1}.png`" alt="" />
            </template>
        </CarouselHero>
        <div class="originals-showcase-container">
            <h2>Oriģināli</h2>
            <div class="product-showcase">
                <div class="showcase-text">
                    <h4>Stāsts</h4>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Deserunt, quas corrupti modi dolor, dicta iure earum
                        eaque beatae totam ullam sequi nemo cum harum iusto.
                        Esse temporibus sunt similique dolor.
                    </p>
                </div>
                <div class="showcase-images">
                    <img
                        class="showcase-image-1"
                        src="../Assets/Images/foto1.webp"
                        alt=""
                    />
                    <img
                        class="showcase-image-2"
                        src="../Assets/Images/foto2.webp"
                        alt=""
                    />
                    <img
                        class="showcase-image-3"
                        src="../Assets/Images/foto3.png"
                        alt=""
                    />
                </div>
            </div>
        </div>
        <div class="banner-image">
            <img src="@\Assets\Images\Image1.png" alt="hero image" />
        </div>
        <div class="originals-showcase-container">
            <h2>Oriģināli</h2>
            <div class="product-showcase">
                <div class="showcase-images">
                    <img
                        class="showcase-image-1"
                        src="../Assets/Images/foto1.webp"
                        alt=""
                    />
                    <img
                        class="showcase-image-2"
                        src="../Assets/Images/foto2.webp"
                        alt=""
                    />
                    <img
                        class="showcase-image-3"
                        src="../Assets/Images/foto3.png"
                        alt=""
                    />
                </div>
                <div class="showcase-text">
                    <h4>Stāsts</h4>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Deserunt, quas corrupti modi dolor, dicta iure earum
                        eaque beatae totam ullam sequi nemo cum harum iusto.
                        Esse temporibus sunt similique dolor.
                    </p>
                </div>
            </div>
        </div>
        <div class="banner-image">
            <img src="@\Assets\Images\Image1.png" alt="hero image" />
        </div>
        <div class="originals-showcase-container">
            <h2>Oriģināli</h2>
            <div class="product-showcase">
                <div class="showcase-text">
                    <h4>Stāsts</h4>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Deserunt, quas corrupti modi dolor, dicta iure earum
                        eaque beatae totam ullam sequi nemo cum harum iusto.
                        Esse temporibus sunt similique dolor.
                    </p>
                </div>
                <div class="showcase-images">
                    <img
                        class="showcase-image-1"
                        src="../Assets/Images/foto1.webp"
                        alt=""
                    />
                    <img
                        class="showcase-image-2"
                        src="../Assets/Images/foto2.webp"
                        alt=""
                    />
                    <img
                        class="showcase-image-3"
                        src="../Assets/Images/foto3.png"
                        alt=""
                    />
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import CarouselHero from "@/Components/CarouselHero.vue";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});
</script>

<style lang="scss" scoped>
.originals-showcase-container {
    width: 100%;
    height: 55vh;
    display: flex;
    gap: 2rem;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin: 7rem 0;

    .product-showcase {
        width: 90%;
        max-width: 75rem;
        height: 100%;
        background-color: var(--secondary);
        display: flex;
        flex-direction: row;

        @media (max-width: 768px) {
            flex-direction: column;
        }

        .showcase-text {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;

            padding: 2rem 1rem;
        }

        .showcase-images {
            position: relative;
            width: 100%;
            height: 100%;
            img {
                box-shadow: 0 10px 50px #0000002a;
                object-fit: cover;
            }
            .showcase-image-1 {
                height: 10em;
                position: absolute;
                top: 15%;
                left: 25%;
                transform: translate(-50%, -50%);
                z-index: 1;
            }

            .showcase-image-2 {
                height: 25em;
                position: absolute;
                top: 60%;
                left: 50%;
                transform: translate(-50%, -50%);
                z-index: 0;
            }

            .showcase-image-3 {
                height: 13rem;
                position: absolute;
                top: 100%;
                left: 80%;
                transform: translate(-50%, -50%);
                z-index: 1;
            }
        }
    }
}

.banner-image {
    width: 100%;
    height: 45rem;

    img {
        object-fit: cover;
        width: 100%;
        height: 100%;
    }
}
</style>
