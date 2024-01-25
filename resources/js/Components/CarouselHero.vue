<template>
    <swiper
        :modules="modules"
        :slides-per-view="1"
        :space-between="5"
        :loop="true"
        :pagination="{ clickable: true }"
        :centeredSlides="true"
        :autoplay="{
            delay: 5000,
            disableOnInteraction: false,
        }"
        :speed="2000"
        @swiper="onSwiper"
        @slideChange="onSlideChange"
        class="swiper"
    >
        <swiper-slide class="swiper-slide">
            <img src="../Assets/Images/Image1.png" alt="" />
        </swiper-slide>
        <swiper-slide class="swiper-slide">
            <img src="../Assets/Images/Image2.png" alt="" />
        </swiper-slide>
        <swiper-slide class="swiper-slide">
            <img src="../Assets/Images/Image3.png" alt="" />
        </swiper-slide>
    </swiper>
</template>
<script>
import { Swiper, SwiperSlide } from "swiper/vue";
import { Autoplay, Navigation, Pagination } from "swiper/modules";

import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";

export default {
    components: {
        Swiper,
        SwiperSlide,
    },
    setup() {
        const onSwiper = (swiper) => {
            console.log(swiper);
        };
        const onSlideChange = () => {};
        return {
            onSwiper,
            onSlideChange,
            modules: [Autoplay, Navigation, Pagination],
        };
    },
};
</script>

<style lang="scss" scoped>
.swiper {
    height: 65vh;
    width: 100%;
    user-select: none;
    overflow: hidden;

    .swiper-slide {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        width: 100%;
        object-fit: cover;
        overflow: hidden;

        img {
            width: 100%;
            overflow: hidden;
        }
    }
}
</style>
