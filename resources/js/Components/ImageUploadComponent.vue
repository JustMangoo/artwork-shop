<template>
    <div class="image-upload-container">
        <div v-if="imagePreviewUrl" class="image-preview-container">
            <img :src="imagePreviewUrl" class="image-preview" />
            <button @click="removeImage" class="remove-image-btn">
                <img src="../Assets/xmark.svg" alt="remove icon" />
            </button>
        </div>
        <div v-else @click="triggerFileInput" class="image-upload-placeholder">
            <img src="../Assets/upload.svg" alt="upload" />
        </div>
        <input
            type="file"
            ref="fileInput"
            @change="handleImageUpload"
            class="hidden"
        />
    </div>
</template>

<script>
export default {
    name: "ImageUploadComponent",
    data() {
        return {
            imagePreviewUrl: null,
        };
    },
    props: {
        initialImage: String,
    },
    mounted() {
        if (this.initialImage) {
            this.imagePreviewUrl = this.initialImage;
        }
    },
    methods: {
        triggerFileInput() {
            this.$refs.fileInput.click();
        },
        handleImageUpload(event) {
            const file = event.target.files[0];
            if (file && file.type.match("image.*")) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.imagePreviewUrl = e.target.result;
                    this.$emit("image-added", file);
                };
                reader.readAsDataURL(file);
            }
        },
        removeImage() {
            this.imagePreviewUrl = null;
            this.$emit("image-removed");
        },
    },
};
</script>

<style lang="scss" scoped>
.image-upload-container {
    width: 30%;
    aspect-ratio: 3 / 4;
    border: 2px dashed #ccc;
    border-radius: var(--border-rad);
    position: relative;
    cursor: pointer;

    .image-upload-placeholder {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;

        img {
            max-width: 50%;
            max-height: 50%;
            object-fit: cover;
        }

        span {
            position: absolute;
            bottom: 15px;
            right: 15px;
            font-size: 24px;
        }
    }

    .image-preview {
        object-fit: cover;
        aspect-ratio: 3/ 4;
    }
    .remove-image-btn {
        position: absolute;
        top: -8px;
        right: -8px;

        img {
            width: 20px;
            background-color: var(--primary);
            border-radius: 50%;
        }
    }
}
</style>
