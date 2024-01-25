<template>
    <swiper
        :slidesPerView="4"
        :spaceBetween="40"
        :centeredSlides="true"
        :modules="modules"
        :loop="true"
        :autoplay="{
            delay: 0,
        }"
        :allowTouchMove="false"
        :speed="5000"
        class="mySwiper"
    >
        <swiper-slide>
            <img src="../Assets/Images/Image1.png" alt="" />
            <p>"Cherry Wine" Fine Art Print</p>
            <p>From $27,95</p>
        </swiper-slide>
        <swiper-slide>
            <img src="../Assets/Images/Image2.png" alt="" />
            <p>"Cherry Wine" Fine Art Print</p>
            <p>From $27,95</p>
        </swiper-slide>
        <swiper-slide>
            <img src="../Assets/Images/Image3.png" alt="" />
            <p>"Cherry Wine" Fine Art Print</p>
            <p>From $27,95</p>
        </swiper-slide>
        <swiper-slide>
            <img src="../Assets/Images/Image4.png" alt="" />
            <p>"Cherry Wine" Fine Art Print</p>
            <p>From $27,95</p>
        </swiper-slide>
        <swiper-slide>
            <img src="../Assets/Images/Image5.png" alt="" />
            <p>"Cherry Wine" Fine Art Print</p>
            <p>From $27,95</p>
        </swiper-slide>
        <swiper-slide>
            <img src="../Assets/Images/Image5.png" alt="" />
            <p>"Cherry Wine" Fine Art Print</p>
            <p>From $27,95</p>
        </swiper-slide>
        <swiper-slide>
            <img src="../Assets/Images/Image5.png" alt="" />
            <p>"Cherry Wine" Fine Art Print</p>
            <p>From $27,95</p>
        </swiper-slide>
    </swiper>
</template>
<script>
import { Swiper, SwiperSlide, useSwiper } from "swiper/vue";

import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";

import { Autoplay } from "swiper/modules";

export default {
    components: {
        Swiper,
        SwiperSlide,
    },
    setup() {
        const swiper = useSwiper();

        return {
            modules: [Autoplay],
            swiper,
        };
    },
};
</script>

<style lang="scss" scoped>
.swiper {
    width: 100%;
    height: 100%;
    user-select: none;
    pointer-events: none;
    overflow: hidden;
}

.swiper-slide {
    text-align: center;
    font-size: 18px;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    justify-content: center;
    align-items: center;
    aspect-ratio: 4 / 3;

    img {
        display: block;
        object-fit: cover;
        aspect-ratio: 4 / 3;
    }
}
</style>
