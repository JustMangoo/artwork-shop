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
        <swiper-slide class="swiper-slide slide-1" v-slot="{ isActive }">
            <div class="slide-content" :class="{ active: isActive }">
                <h1>Jauni Izlaidumi</h1>
                <p>Jaunas gleznas un produkti!</p>
                <button>Skatīt</button>
            </div>
        </swiper-slide>
        <swiper-slide class="swiper-slide slide-2" v-slot="{ isActive }">
            <div class="slide-content" :class="{ active: isActive }">
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
            transform: translateY(100%); /* Start below viewport */
            transition: opacity 1s ease-in-out, transform 1s ease-in-out;
            transition-delay: 1.5s;
            opacity: 0;

            &.active {
                opacity: 1;
                transform: translateY(0); /* Slide up to normal position */
            }

            h1 {
                font-size: 8rem;
            }

            p {
                font-size: 2rem;
            }
        }

        &.slide-1 {
            background-image: linear-gradient(
                    0deg,
                    rgba(0, 0, 0, 0.3),
                    rgba(0, 0, 0, 0.3)
                ),
                url("@/Assets/Images/john-schaidler.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;

            h1 {
                color: var(--color--light);
            }

            p {
                color: var(--color--light);
            }
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
