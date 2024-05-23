<template>
    <SystemAlert :message="SystemAlert" :type="messageType" />
    <footer>
        <!-- Copyright -->
        <p class="copyright">© 2024 Aleksis Daugats</p>
    </footer>
</template>

<script>
import { useForm } from "@inertiajs/vue3";

import SystemAlert from "@/Components/SystemAlert.vue";

export default {
    components: {
        SystemAlert,
    },
    setup() {
        const form = useForm({
            email: "",
        });

        return { form };
    },
    methods: {
        setSystemAlert(message, type = "info") {
            this.SystemAlert = message;
            this.messageType = type;
        },
    },
    data() {
        return {
            SystemAlert: "",
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
