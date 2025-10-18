<template>
  <div class="image-upload-container">
    <label class="label">
      <span class="label-content">
        <img src="@/assets/icons/create-profile.svg" class="label-icon">
        Foto de perfil (opcional)
      </span>
    </label>
    
    <div class="upload-area" @click="triggerFileInput" @dragover.prevent @drop.prevent="handleDrop">
      <input 
        ref="fileInput" 
        type="file" 
        accept="image/*" 
        @change="handleFileSelect" 
        class="file-input"
      >
      
      <div v-if="!previewUrl" class="upload-placeholder">
        <img src="@/assets/icons/upload.svg" class="upload-icon">
        <p class="upload-text">Clique ou arraste uma imagem</p>
        <p class="upload-subtext">PNG, JPG até 2MB</p>
      </div>
      
      <div v-else class="image-preview">
        <img :src="previewUrl" alt="Preview" class="preview-image">
        <button @click.stop="removeImage" class="remove-button">
          <img src="@/assets/icons/x.svg" class="remove-icon">
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ImageUploadComponent',
  data() {
    return {
      previewUrl: null,
      selectedFile: null
    }
  },
  methods: {
    triggerFileInput() {
      this.$refs.fileInput.click();
    },
    
    handleFileSelect(event) {
      const file = event.target.files[0];
      this.processFile(file);
    },
    
    handleDrop(event) {
      const file = event.dataTransfer.files[0];
      this.processFile(file);
    },
    
    processFile(file) {
      if (!file || !file.type.startsWith('image/')) {
        return;
      }
      
      if (file.size > 2 * 1024 * 1024) {
        alert('A imagem deve ter no máximo 2MB');
        return;
      }
      
      this.selectedFile = file;
      this.previewUrl = URL.createObjectURL(file);
      this.$emit('image-selected', file);
    },
    
    removeImage() {
      this.selectedFile = null;
      this.previewUrl = null;
      this.$refs.fileInput.value = '';
      this.$emit('image-removed');
    }
  }
}
</script>

<style scoped>
.image-upload-container {
  display: flex;
  flex-direction: column;
  gap: 8px;
  width: 100%;
}

.label {
  display: flex;
  align-items: center;
  gap: 4px;
  color: #d4d4d8;
  font: 14px "Poppins", sans-serif;
}

.label-content {
  display: flex;
  align-items: center;
  gap: 8px;
}

.label-icon {
  width: 16px;
  height: 16px;
}

.upload-area {
  position: relative;
  border: 2px dashed rgba(225, 12, 255, 0.3);
  border-radius: 14px;
  background-color: rgba(255, 255, 255, 0.05);
  cursor: pointer;
  transition: border-color 0.2s;
  min-height: 120px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.upload-area:hover {
  border-color: rgba(225, 12, 255, 0.5);
}

.file-input {
  display: none;
}

.upload-placeholder {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 8px;
  padding: 20px;
}

.upload-icon {
  width: 24px;
  height: 24px;
  opacity: 0.7;
}

.upload-text {
  color: #d4d4d8;
  font: 14px "Poppins", sans-serif;
  margin: 0;
}

.upload-subtext {
  color: #64748b;
  font: 12px "Poppins", sans-serif;
  margin: 0;
}

.image-preview {
  position: relative;
  width: 100px;
  height: 100px;
}

.preview-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 50%;
}

.remove-button {
  position: absolute;
  top: -5px;
  right: -5px;
  width: 24px;
  height: 24px;
  border-radius: 50%;
  background: #ef4444;
  border: none;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: background-color 0.2s;
}

.remove-button:hover {
  background: #dc2626;
}

.remove-icon {
  width: 12px;
  height: 12px;
  filter: invert(1);
}
</style>