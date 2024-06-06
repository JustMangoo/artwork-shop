<template>
    <footer>
        <!-- Copyright -->
        <p class="copyright">© 2024 Aleksis Daugats</p>
    </footer>
</template>

<script>
import { useForm } from "@inertiajs/vue3";


export default {
    components: {

    },
    setup() {
        const form = useForm({
            email: "",
        });

        return { form };
    },
    methods: {},
    data() {
        return {

            messageType: "info",
        };
    },
};
</script>

<style lang="scss">
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

    .copyright {
        font-size: 0.9rem;
    }
}
</style>
