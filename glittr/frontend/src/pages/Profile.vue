<template>
  <div class="profile-page">
    <header class="header">
      <HeaderSectionComponent/>
    </header>

    <main class="profile-content">
      <div class="profile-container">
        <div class="profile-header">
          <h1>Editar Perfil</h1>
          <p>Atualize suas informações pessoais</p>
        </div>

        <form @submit.prevent="updateProfile" class="profile-form">
          <div class="profile-image-section">
            <div class="current-image">
              <img 
                :src="previewImage || currentProfileImage || defaultAvatar" 
                alt="Foto de perfil" 
                class="profile-preview"
              >
            </div>
            <div class="image-upload">
              <label for="profile-image" class="upload-button">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M21 15V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M17 8L12 3L7 8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M12 3V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Alterar Foto
              </label>
              <input 
                type="file" 
                id="profile-image" 
                accept="image/*" 
                @change="handleImageUpload"
                class="hidden-input"
              >
            </div>
          </div>

          <div class="form-group">
            <label for="name">Nome</label>
            <input 
              type="text" 
              id="name" 
              v-model="form.name" 
              class="form-input"
              required
            >
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input 
              type="email" 
              id="email" 
              v-model="form.email" 
              class="form-input"
              disabled
            >
            <small>O email não pode ser alterado</small>
          </div>

          <div class="form-actions">
            <button type="button" @click="cancelEdit" class="cancel-button">
              Cancelar
            </button>
            <button type="submit" :disabled="isLoading" class="save-button">
              <div v-if="isLoading" class="loading-spinner"></div>
              {{ isLoading ? 'Salvando...' : 'Salvar Alterações' }}
            </button>
          </div>
        </form>
      </div>
    </main>
  </div>
</template>

<script>
import HeaderSectionComponent from '../components/HeaderSectionComponent.vue'
import PostUserDataService from '@/services/PostUserDataService.js'
import {showGlittrModal} from '@/stores/useSweetAlertGlittr.js'

export default {
  name: 'Profile',
  components: {
    HeaderSectionComponent
  },
  data() {
    return {
      form: {
        name: '',
        email: ''
      },
      currentProfileImage: null,
      previewImage: null,
      selectedFile: null,
      isLoading: false,
      defaultAvatar: 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgdmlld0JveD0iMCAwIDEwMCAxMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIxMDAiIGhlaWdodD0iMTAwIiBmaWxsPSIjRjNGNEY2Ii8+CjxwYXRoIGQ9Ik01MCA1MEMzNy41IDUwIDI3LjUgNDAIDI3LjUgMjcuNUMyNy41IDE1IDM3LjUgNSA1MCA1QzYyLjUgNSA3Mi41IDE1IDcyLjUgMjcuNUM3Mi41IDQwIDYyLjUgNTAgNTAgNTBaTTUwIDYwQzY5LjMzIDYwIDg1IDc1LjY3IDg1IDk1SDEwQzEwIDc1LjY3IDI1LjY3IDYwIDQ1IDYwSDUwWiIgZmlsbD0iIzlDQTNBRiIvPgo8L3N2Zz4K'
    }
  },
  async mounted() {
    await this.loadUserData()
  },
  methods: {
    async loadUserData() {
      try {
        const response = await PostUserDataService.getUser()
        const user = response.data.me
        
        this.form.name = user.name
        this.form.email = user.email
        
        if (user.profile_image_url) {
          const hostname = window.location.hostname
          const baseUrl = (hostname === 'localhost' || hostname === '127.0.0.1') 
              ? 'http://127.0.0.1:8000' 
              : 'http://3.21.55.156'
          
          this.currentProfileImage = user.profile_image_url.startsWith('http') 
            ? user.profile_image_url 
            : `${baseUrl}/storage/${user.profile_image_url.replace(/^\/storage\//, '')}`
        }
      } catch (error) {
        console.error('Erro ao carregar dados do usuário:', error)
      }
    },
    
    handleImageUpload(event) {
      const file = event.target.files[0]
      if (!file) return
      
      if (!file.type.startsWith('image/')) {
        showGlittrModal({
          icon: 'error',
          title: 'Arquivo inválido',
          text: 'Por favor, selecione apenas arquivos de imagem.',
          confirmButtonText: 'OK'
        })
        return
      }
      
      if (file.size > 2 * 1024 * 1024) {
        showGlittrModal({
          icon: 'error',
          title: 'Arquivo muito grande',
          text: 'A imagem deve ter no máximo 2MB.',
          confirmButtonText: 'OK'
        })
        return
      }
      
      this.selectedFile = file
      
      const reader = new FileReader()
      reader.onload = (e) => {
        this.previewImage = e.target.result
      }
      reader.readAsDataURL(file)
    },
    
    async updateProfile() {
      this.isLoading = true
      
      try {
        const formData = new FormData()
        formData.append('name', this.form.name)
        
        if (this.selectedFile) {
          formData.append('profile_image', this.selectedFile)
        }
        
        await PostUserDataService.updateProfile(formData)
        
        localStorage.setItem('user', this.form.name)
        
        showGlittrModal({
          icon: 'success',
          title: 'Perfil atualizado!',
          text: 'Suas informações foram atualizadas com sucesso.',
          confirmButtonText: 'OK'
        })
        
        await this.loadUserData()
        this.previewImage = null
        this.selectedFile = null
        
      } catch (error) {
        showGlittrModal({
          icon: 'error',
          title: 'Erro ao atualizar',
          text: error.response?.data?.message || 'Ocorreu um erro ao atualizar o perfil.',
          confirmButtonText: 'OK'
        })
      } finally {
        this.isLoading = false
      }
    },
    
    cancelEdit() {
      this.$router.push('/')
    }
  }
}
</script>

<style scoped>
.profile-page {
  min-height: 100vh;
  background-color: #f8fafc;
}

.profile-content {
  padding: 40px 20px;
  display: flex;
  justify-content: center;
}

.profile-container {
  background: white;
  border-radius: 16px;
  padding: 32px;
  max-width: 600px;
  width: 100%;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.profile-header {
  text-align: center;
  margin-bottom: 32px;
}

.profile-header h1 {
  color: #141414;
  font-family: 'Poppins', sans-serif;
  font-size: 28px;
  font-weight: 600;
  margin: 0 0 8px 0;
}

.profile-header p {
  color: #757575;
  font-family: 'Poppins', sans-serif;
  font-size: 16px;
  margin: 0;
}

.profile-image-section {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-bottom: 32px;
}

.current-image {
  margin-bottom: 16px;
}

.profile-preview {
  width: 120px;
  height: 120px;
  border-radius: 50%;
  object-fit: cover;
  border: 4px solid #E10CFF;
}

.upload-button {
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 10px 20px;
  background: linear-gradient(90deg, #ED008C 0%, #E10CFF 100%);
  color: white;
  border-radius: 8px;
  cursor: pointer;
  font-family: 'Poppins', sans-serif;
  font-size: 14px;
  font-weight: 500;
  transition: transform 0.2s;
}

.upload-button:hover {
  transform: translateY(-2px);
}

.hidden-input {
  display: none;
}

.form-group {
  margin-bottom: 24px;
}

.form-group label {
  display: block;
  color: #ED008C;
  font-family: 'Poppins', sans-serif;
  font-size: 16px;
  font-weight: 500;
  margin-bottom: 8px;
}

.form-input {
  width: 100%;
  height: 48px;
  padding: 0 16px;
  border: 2px solid #e2e8f0;
  border-radius: 8px;
  font-family: 'Poppins', sans-serif;
  font-size: 16px;
  transition: border-color 0.2s;
}

.form-input:focus {
  outline: none;
  border-color: #E10CFF;
}

.form-input:disabled {
  background-color: #f8fafc;
  color: #757575;
  cursor: not-allowed;
}

.form-group small {
  color: #757575;
  font-size: 12px;
  margin-top: 4px;
  display: block;
}

.form-actions {
  display: flex;
  gap: 16px;
  justify-content: flex-end;
  margin-top: 32px;
}

.cancel-button {
  padding: 12px 24px;
  background: #f1f5f9;
  color: #64748b;
  border: none;
  border-radius: 8px;
  font-family: 'Poppins', sans-serif;
  font-size: 14px;
  font-weight: 500;
  cursor: pointer;
  transition: background-color 0.2s;
}

.cancel-button:hover {
  background: #e2e8f0;
}

.save-button {
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 12px 24px;
  background: linear-gradient(90deg, #ED008C 0%, #E10CFF 100%);
  color: white;
  border: none;
  border-radius: 8px;
  font-family: 'Poppins', sans-serif;
  font-size: 14px;
  font-weight: 500;
  cursor: pointer;
  transition: transform 0.2s;
}

.save-button:hover:not(:disabled) {
  transform: translateY(-2px);
}

.save-button:disabled {
  opacity: 0.7;
  cursor: not-allowed;
}

.loading-spinner {
  width: 16px;
  height: 16px;
  border: 2px solid white;
  border-top: 2px solid transparent;
  border-radius: 50%;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

@media (max-width: 768px) {
  .profile-container {
    padding: 24px;
    margin: 0 16px;
  }
  
  .form-actions {
    flex-direction: column;
  }
  
  .cancel-button,
  .save-button {
    width: 100%;
    justify-content: center;
  }
}
</style>