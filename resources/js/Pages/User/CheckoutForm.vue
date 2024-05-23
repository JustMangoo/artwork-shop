<template>
    <MainLayout>
        <form class="checkout-form">
            <div class="form-section">
                <h3>Shipping Address</h3>

                <div class="form-group">
                    <label for="full-name">Full Name</label>
                    <input
                        type="text"
                        id="full-name"
                        v-model="formData.fullName"
                    />
                </div>

                <div class="form-group">
                    <label for="address-line1">Address Line 1</label>
                    <input
                        type="text"
                        id="address-line1"
                        v-model="formData.address1"
                    />
                </div>

                <div class="form-group">
                    <label for="address-line2">Address Line 2 (Optional)</label>
                    <input
                        type="text"
                        id="address-line2"
                        v-model="formData.address2"
                    />
                </div>

                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" id="city" v-model="formData.city" />
                </div>
            </div>

            <div class="form-section">
                <h3>Payment Information</h3>
            </div>
            <div class="form-actions">
                <button type="submit">Place Order</button>
            </div>
        </form>
    </MainLayout>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout.vue";
export default {
    components: {
        MainLayout,
    },
    data() {
        return {
            formData: {
                fullName: "",
                address1: "",
                address2: "",
                city: "",
                // ... add other fields as needed
            },
        };
    },
    // ... (methods to handle form submission)
};
</script>

<style lang="scss" scoped>
/* Form Container */
.checkout-form {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1rem;

    .form-section {
        border: 1px solid var(--color--light);
        padding: 1rem;
        border-radius: var(--rounded-box);
    }

    .form-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 1rem;
    }

    label {
        font-weight: bold;
        margin-bottom: 0.5rem;
    }
}
</style>
