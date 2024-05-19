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
        <swiper-slide class="swiper-slide slide-1">
            <div class="slide-content">
                <h1>Jauni Izlaidumi</h1>
                <p>Jaunas gleznas un produkti!</p>
                <button>Skatīt</button>
            </div>
        </swiper-slide>
        <swiper-slide class="swiper-slide slide-2">
            <div class="slide-content">
                <h1>Stāsts Par Mani</h1>
                <p>Iepazīsties ar to ko daru</p>
                <button>Lasīt vairāk</button>
            </div>
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
    height: 75vh;
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
        width: 100%;
        overflow: hidden;

        .slide-content {
            width: 80%;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            align-items: baseline;

            p {
                font-size: 2rem;
            }
        }

        &.slide-1 {
            background-image: url("@/Assets/Images/Image1.png");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }

        &.slide-2 {
            background-image: url("@/Assets/Images/Image2.png");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }
    }
}
</style>
