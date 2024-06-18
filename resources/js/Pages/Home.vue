<template>
    <Head title="Sveicināti" />

    <MainLayout>
        <CarouselHero />
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
                    <a
                        href="/products-customer/Originals"
                        class="showcase-link"
                    >
                        <p>Skatīt</p>
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                            stroke-width="1"
                            stroke="#000000"
                        >
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g
                                id="SVGRepo_tracerCarrier"
                                stroke-linecap="sharp"
                                stroke-linejoin="sharp"
                            ></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M4 12H20M20 12L16 8M20 12L16 16"
                                    stroke-linecap="sharp"
                                    stroke-linejoin="sharp"
                                ></path>
                            </g>
                        </svg>
                    </a>
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
            <h2>Printēti</h2>
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
                    <a href="/products-customer/Printets" class="showcase-link">
                        <p>Skatīt</p>
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                            stroke-width="1"
                            stroke="#000000"
                        >
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g
                                id="SVGRepo_tracerCarrier"
                                stroke-linecap="sharp"
                                stroke-linejoin="sharp"
                            ></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M4 12H20M20 12L16 8M20 12L16 16"
                                    stroke-linecap="sharp"
                                    stroke-linejoin="sharp"
                                ></path>
                            </g>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="banner-image">
            <img src="@\Assets\Images\Image1.png" alt="hero image" />
        </div>
        <div class="originals-showcase-container">
            <h2>Kokdarbi</h2>
            <div class="product-showcase">
                <div class="showcase-text">
                    <h4>Stāsts</h4>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Deserunt, quas corrupti modi dolor, dicta iure earum
                        eaque beatae totam ullam sequi nemo cum harum iusto.
                        Esse temporibus sunt similique dolor.
                    </p>

                    <a href="/products-customer/Kokdarbi" class="showcase-link">
                        <p>Skatīt</p>
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                            stroke-width="1"
                            stroke="#000000"
                        >
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g
                                id="SVGRepo_tracerCarrier"
                                stroke-linecap="sharp"
                                stroke-linejoin="sharp"
                            ></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M4 12H20M20 12L16 8M20 12L16 16"
                                    stroke-linecap="sharp"
                                    stroke-linejoin="sharp"
                                ></path>
                            </g>
                        </svg>
                    </a>
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
    @media (max-width: 768px) {
        height: 100%;
    }

    .product-showcase {
        width: 90%;
        max-width: 75rem;
        height: 100%;

        background-color: var(--color--secondary);
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
            gap: 1rem;
            padding: 2rem 1rem;

            .showcase-link {
                display: flex;
                align-items: center;
                gap: 8px;
                cursor: pointer;

                p {
                    color: var(--color--primary);
                }

                svg {
                    height: 2rem;
                    width: auto;
                    stroke: var(--color--primary);
                    transition: transform 0.3s ease;
                    transform: scaleX(1.5);
                    transform-origin: left;
                }

                &:hover svg {
                    transform: scaleX(2);
                    transform-origin: left;
                }
            }
        }

        .showcase-images {
            position: relative;
            width: 100%;

            @media (max-width: 768px) {
                padding: 1rem;
                height: 50vw;
            }

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

                @media (max-width: 768px) {
                    display: none;
                }
            }

            .showcase-image-2 {
                height: 25em;
                position: absolute;
                top: 60%;
                left: 50%;
                transform: translate(-50%, -50%);
                z-index: 0;
                @media (max-width: 768px) {
                    position: static;
                    transform: none;
                    width: 100%;
                    height: 100%;
                }
            }

            .showcase-image-3 {
                height: 13rem;
                position: absolute;
                top: 100%;
                left: 80%;
                transform: translate(-50%, -50%);
                z-index: 1;
                @media (max-width: 768px) {
                    display: none;
                }
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
