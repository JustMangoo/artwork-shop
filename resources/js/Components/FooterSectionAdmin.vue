<template>
    <SystemMessage :message="systemMessage" :type="messageType" />
    <footer>
        <!-- Copyright -->
        <p class="copyright">© 2024 Aleksis Daugats</p>
    </footer>
</template>

<script>
import { useForm } from "@inertiajs/vue3";

import SystemMessage from "@/Components/SystemMessage.vue";

export default {
    components: {
        SystemMessage,
    },
    setup() {
        const form = useForm({
            email: "",
        });

        return { form };
    },
    methods: {
        setSystemMessage(message, type = "info") {
            this.systemMessage = message;
            this.messageType = type;
        },
    },
    data() {
        return {
            systemMessage: "",
            messageType: "info",
        };
    },
};
</script>

<style lang="scss">
footer {
    background-color: var(--secondary);
    padding: 2rem 0;
    color: var(--dark);
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
