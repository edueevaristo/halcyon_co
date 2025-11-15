<template>
  <div v-if="isVisible" class="modal-overlay" @click="closeModal">
    <div class="modal-content" @click.stop>
      <div class="modal-header">
        <h2>🌟 Funcionalidade Premium</h2>
        <button @click="closeModal" class="close-button">&times;</button>
      </div>

      <div class="modal-body">
        <p>Esta funcionalidade está disponível apenas para usuários premium.</p>
        <p>Entre em contato conosco para solicitar acesso:</p>

        <div class="contact-info">
          <strong style="color: #333;">Email: </strong>
          <a :href="emailLink" class="email-link">contato@glittr.com.br</a>
        </div>

        <div class="user-info">
          <p><strong>Seus dados:</strong></p>
          <p>ID: {{ userInfo?.id || 'N/A' }}</p>
          <p>Nome: {{ userInfo?.name || 'N/A' }}</p>
          <p>Email: {{ userInfo?.email || 'N/A' }}</p>
        </div>
      </div>

      <div class="modal-footer">
        <button @click="sendRequest" class="premium-button" :disabled="loading">
          {{ loading ? 'Enviando...' : 'Solicitar Acesso Premium' }}
        </button>
        <button @click="closeModal" class="cancel-button">Cancelar</button>
      </div>
    </div>
  </div>
</template>

<script>
import http from '@/http-common'
import {useAuth} from '@/stores/auth'

export default {
  name: 'PremiumModalComponent',
  props: {
    isVisible: {
      type: Boolean,
      default: false
    },
    action: {
      type: String,
      default: 'premium_feature'
    }
  },
  emits: ['close'],
  data() {
    return {
      loading: false
    }
  },
  computed: {
    userInfo() {
      const auth = useAuth()
      return auth.user || {
        id: localStorage.getItem('user_id'),
        name: localStorage.getItem('user'),
        email: localStorage.getItem('email')
      }
    },
    emailLink() {
      const subject = encodeURIComponent('Solicitação de Acesso Premium - Glittr')
      const body = encodeURIComponent(`
Olá,

Gostaria de solicitar acesso premium para a plataforma Glittr.

Meus dados:
- ID: ${this.userInfo?.id || 'N/A'}
- Nome: ${this.userInfo?.name || 'N/A'}
- Email: ${this.userInfo?.email || 'N/A'}
- Funcionalidade solicitada: ${this.getActionText()}
- Data/Hora: ${new Date().toLocaleString('pt-BR')}

Aguardo retorno.

Obrigado!
      `)
      return `mailto:contato@glittr.com.br?subject=${subject}&body=${body}`
    }
  },
  methods: {
    closeModal() {
      this.$emit('close')
    },

    getActionText() {
      const actions = {
        'product_like': 'Curtir produtos',
        'reviews': 'Visualizar avaliações',
        'comments': 'Comentários',
        'review_details': 'Detalhes de avaliações',
        'add_review': 'Adicionar avaliação'
      }
      return actions[this.action] || 'Funcionalidade premium'
    },

    async sendRequest() {
      this.loading = true
      try {
        await http.post('/contact/premium-request', {
          action: this.action
        })

        // Abrir cliente de email
        window.location.href = this.emailLink

        this.closeModal()
      } catch (error) {
        console.error('Erro ao enviar solicitação:', error)
      } finally {
        this.loading = false
      }
    }
  }
}
</script>

<style scoped>
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.modal-content {
  background: white;
  border-radius: 16px;
  max-width: 500px;
  width: 90%;
  max-height: 90vh;
  overflow-y: auto;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px;
  border-bottom: 1px solid #eee;
}

.modal-header h2 {
  margin: 0;
  color: #9400EF;
  font-family: 'Poppins', sans-serif;
  font-size: 20px;
  font-weight: 600;
}

.close-button {
  background: none;
  border: none;
  font-size: 24px;
  cursor: pointer;
  color: #666;
  padding: 0;
  width: 30px;
  height: 30px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.close-button:hover {
  color: #9400EF;
}

.modal-body {
  padding: 20px;
}

.modal-body p {
  margin: 0 0 16px 0;
  color: #333;
  font-family: 'Poppins', sans-serif;
  line-height: 1.5;
}

.contact-info {
  background: #f8f9fa;
  padding: 16px;
  border-radius: 8px;
  margin: 16px 0;
}

.email-link {
  color: #9400EF;
  text-decoration: none;
  font-weight: 500;
}

.email-link:hover {
  text-decoration: underline;
}

.user-info {
  background: #f0f0f0;
  padding: 16px;
  border-radius: 8px;
  margin: 16px 0;
}

.user-info p {
  margin: 4px 0;
  font-size: 14px;
}

.modal-footer {
  padding: 20px;
  border-top: 1px solid #eee;
  display: flex;
  gap: 12px;
  justify-content: flex-end;
}

.premium-button {
  background: linear-gradient(90deg, #9400EF 0%, #E10CFF 100%);
  color: white;
  border: none;
  padding: 12px 24px;
  border-radius: 8px;
  font-family: 'Poppins', sans-serif;
  font-weight: 600;
  cursor: pointer;
  transition: opacity 0.2s;
}

.premium-button:hover:not(:disabled) {
  opacity: 0.9;
}

.premium-button:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

.cancel-button {
  background: #f5f5f5;
  color: #666;
  border: none;
  padding: 12px 24px;
  border-radius: 8px;
  font-family: 'Poppins', sans-serif;
  font-weight: 500;
  cursor: pointer;
}

.cancel-button:hover {
  background: #e0e0e0;
}
</style>