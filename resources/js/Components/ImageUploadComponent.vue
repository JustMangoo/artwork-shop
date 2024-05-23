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
        <input type="file" ref="fileInput" @change="handleImageUpload" hidden />
    </div>
</template>

<script>
export default {
    name: "ImageUploadComponent",
    props: {
        initialImage: String,
        imageId: [String, Number],
        index: Number,
    },
    data() {
        return {
            imagePreviewUrl: null,
            componentId: this.generateUniqueId(),
        };
    },
    created() {
        console.log(
            `Component created with imageId: ${this.imageId}, index: ${this.index}, initialImage: ${this.initialImage}`
        );
    },
    mounted() {
        if (this.initialImage) {
            this.imagePreviewUrl = this.initialImage;
            this.$emit("image-loaded", {
                imagePreviewUrl: this.initialImage,
                id: this.componentId,
                index: this.index,
            });
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
                    this.$emit("image-added", {
                        file,
                        id: this.componentId,
                        index: this.index,
                    });
                };
                reader.readAsDataURL(file);
            }
        },
        removeImage() {
            this.$emit("image-removed", {
                id: this.imageId,
                index: this.index,
            });
            this.imagePreviewUrl = null;
        },
        generateUniqueId() {
            return `image-upload-${Date.now()}-${Math.random()
                .toString(36)
                .substr(2, 9)}`;
        },
    },
};
</script>

<style lang="scss" scoped>
.image-upload-container {
    width: 100%;
    aspect-ratio: 3 / 4;
    border: 2px dashed #ccc;
    border-radius: var(--rounded-box);
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
        width: 100%;
        object-fit: cover;
        aspect-ratio: 3/ 4;
    }
    .remove-image-btn {
        position: absolute;
        top: -8px;
        right: -8px;
        padding: 2px;
        border-radius: 50%;

        img {
            width: 16px;
            background-color: var(--color--primary);
            border-radius: 50%;
        }
    }
}
</style>
