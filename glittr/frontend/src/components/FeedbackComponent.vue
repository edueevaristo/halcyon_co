<template>
  <main class="main-feedbacks">
    <section class="section-feedback-user-and-photo-and-date">
      <div class="feedback-user-and-photo">
        <img
            :src="review.user?.profile_image_url || logoGlittr"
            :alt="`Foto de perfil de ${shortName}`"
            class="profile-image"
        >
      </div>

      <div class="feedback-user-and-date">
        <h1 class="feedback-user-name">{{ shortName }}</h1>
        <p class="feedback-user-date">{{ formattedDate }}</p>
      </div>
    </section>

    <section class="feedback-stars">
      <div v-for="index in 5" :key="index">
        <span v-html="starFilledSvg" v-if="index <= review.stars"></span>
        <span v-html="starEmptySvg" v-else></span>
      </div>
    </section>

    <section class="feedback-description">
      <p>{{ review.comment }}</p>
    </section>

    <!-- Ações da avaliação -->
    <section class="feedback-actions">
      <button 
        v-if="isLoggedIn && review.can_like" 
        @click="toggleLike" 
        class="like-button"
        :class="{ 'liked': review.is_liked }"
      >
        <span v-html="review.is_liked ? heartIconLiked : heartIcon"></span>
        <span>{{ review.likes_count || 0 }}</span>
      </button>
      
      <div v-else-if="review.likes_count > 0" class="like-count-only">
        <span v-html="heartIcon"></span>
        <span>{{ review.likes_count }}</span>
      </div>
      
      <button @click="toggleReplies" class="reply-button">
        <span v-html="commentIcon"></span>
        <span>{{ review.replies_count || 0 }} {{ review.replies_count === 1 ? 'resposta' : 'respostas' }}</span>
      </button>
    </section>

    <!-- Seção de respostas -->
    <section v-if="showReplies" class="replies-section">
      <!-- Formulário para nova resposta -->
      <div v-if="isLoggedIn" class="reply-form">
        <div class="reply-input-container">
          <textarea 
            ref="replyTextarea"
            v-model="newReply" 
            @input="handleReplyInput"
            @keydown="handleKeydown"
            placeholder="Escreva sua resposta... (use @ para mencionar usuários)"
            class="reply-input"
            rows="3"
          ></textarea>
          
          <!-- Dropdown de menções -->
          <div v-if="showMentionDropdown && filteredMentionableUsers.length > 0" class="mention-dropdown">
            <div class="mention-header">Mencionar usuário:</div>
            <div 
              v-for="user in filteredMentionableUsers.slice(0, 5)" 
              :key="user.id"
              @click="selectMention(user)"
              class="mention-item"
            >
              <img :src="getProfileImageUrl(user.profile_image_url)" :alt="user.name" class="mention-avatar">
              <span>{{ user.name }}</span>
            </div>
          </div>
          
          <!-- Mensagem quando não há usuários -->
          <div v-else-if="showMentionDropdown && mentionQuery && filteredMentionableUsers.length === 0" class="mention-dropdown">
            <div class="mention-no-results">Nenhum usuário encontrado</div>
          </div>
        </div>
        
        <button @click="submitReply" class="submit-reply-btn" :disabled="!newReply.trim()">
          Responder
        </button>
      </div>

      <!-- Lista de respostas -->
      <div v-for="reply in replies" :key="reply.id" class="reply-item">
        <div class="reply-header">
          <img 
            :src="getProfileImageUrl(reply.user.profile_image_url)" 
            :alt="reply.user.name"
            class="reply-avatar"
          >
          <div class="reply-info">
            <span class="reply-author">{{ getShortName(reply.user.name) }}</span>
            <span class="reply-date">{{ formatDate(reply.created_at) }}</span>
          </div>
        </div>
        <p class="reply-text" v-html="formatReplyWithMentions(reply.reply)"></p>
        
        <!-- Ações da resposta -->
        <div class="reply-actions">
          <button 
            v-if="isLoggedIn && reply.can_like" 
            @click="toggleReplyLike(reply)" 
            class="reply-like-button"
            :class="{ 'liked': reply.is_liked }"
          >
            <span v-html="reply.is_liked ? heartIconLiked : heartIcon"></span>
            <span>{{ reply.likes_count || 0 }}</span>
          </button>
          
          <div v-else-if="reply.likes_count > 0" class="reply-like-count-only">
            <span v-html="heartIcon"></span>
            <span>{{ reply.likes_count }}</span>
          </div>
        </div>
      </div>
    </section>
  </main>
</template>

<script>
import PostFeedbackDataService from '@/services/PostFeedbackDataService.js';
import logoGlittr from '@/assets/icons/LogoGlittr.svg';

export default {
  name: 'FeedbackComponent',
  props: {
    review: {
      type: Object,
      required: true
    },
    productId: {
      type: Number,
      required: true
    }
  },
  data() {
    return {
      logoGlittr,
      showReplies: false,
      replies: [],
      newReply: '',
      mentionableUsers: [],
      showMentionDropdown: false,
      mentionQuery: '',
      cursorPosition: 0,
      starFilledSvg: `
        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M3.64062 13.125L4.65625 8.73438L1.25 5.78125L5.75 5.39062L7.5 1.25L9.25 5.39062L13.75 5.78125L10.3438 8.73438L11.3594 13.125L7.5 10.7969L3.64062 13.125Z" fill="#E10CFF"/>
        </svg>
      `,
      starEmptySvg: `
        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M5.53125 10.5156L7.5 9.32812L9.46875 10.5312L8.95313 8.28125L10.6875 6.78125L8.40625 6.57812L7.5 4.45312L6.59375 6.5625L4.3125 6.76562L6.04688 8.28125L5.53125 10.5156ZM3.64062 13.125L4.65625 8.73438L1.25 5.78125L5.75 5.39062L7.5 1.25L9.25 5.39062L13.75 5.78125L10.3438 8.73438L11.3594 13.125L7.5 10.7969L3.64062 13.125Z" fill="#757575"/>
        </svg>
      `,
      heartIcon: `
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" fill="#757575"/>
        </svg>
      `,
      heartIconLiked: `
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" fill="#E10CFF"/>
        </svg>
      `,
      commentIcon: `
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M21 6h-2v9H6v2c0 .55.45 1 1 1h11l4 4V7c0-.55-.45-1-1-1zm-4 6V3c0-.55-.45-1-1-1H3c-.55 0-1 .45-1 1v14l4-4h11c.55 0 1-.45 1-1z" fill="currentColor"/>
        </svg>
      `
    }
  },
  computed: {
    shortName() {
      if (!this.review.user?.name) return 'Usuário';
      const names = this.review.user.name.split(' ');
      const titles = ['Sr.', 'Sra.', 'Srta.', 'Dr.', 'Dra.', 'Prof.', 'Profa.'];
      
      // Remove títulos do início
      let filteredNames = names.filter(name => !titles.includes(name));
      if (filteredNames.length === 0) filteredNames = names; // fallback
      
      return `${filteredNames[0]} ${filteredNames.length > 1 ? filteredNames[1].charAt(0) + '.' : ''}`;
    },
    formattedDate() {
      if (!this.review.created_at) return '';
      const date = new Date(this.review.created_at);
      return date.toLocaleDateString('pt-BR') + ' ' + date.toLocaleTimeString('pt-BR', { hour: '2-digit', minute: '2-digit' });
    },
    isLoggedIn() {
      return !!localStorage.getItem('token');
    },
    filteredMentionableUsers() {
      if (!this.mentionQuery) return this.mentionableUsers;
      return this.mentionableUsers.filter(user => 
        user.name.toLowerCase().includes(this.mentionQuery.toLowerCase())
      );
    }
  },
  methods: {
    async toggleLike() {
      if (!this.isLoggedIn) return;
      
      try {
        const response = await PostFeedbackDataService.toggleReviewLike(this.review.id);
        this.review.is_liked = response.data.liked;
        this.review.likes_count = response.data.likes_count;
      } catch (error) {
        console.error('Erro ao dar like:', error);
      }
    },
    
    async toggleReplies() {
      this.showReplies = !this.showReplies;
      
      if (this.showReplies && this.replies.length === 0) {
        await this.loadReplies();
      }
    },
    
    async loadReplies() {
      try {
        const response = await PostFeedbackDataService.getReplies(this.review.id);
        this.replies = response.data.replies;
      } catch (error) {
        console.error('Erro ao carregar respostas:', error);
      }
    },
    
    async submitReply() {
      if (!this.newReply.trim() || !this.isLoggedIn) return;
      
      try {
        const response = await PostFeedbackDataService.createReply(this.review.id, this.newReply);
        this.replies.push(response.data.reply);
        this.review.replies_count = (this.review.replies_count || 0) + 1;
        this.newReply = '';
      } catch (error) {
        console.error('Erro ao enviar resposta:', error);
      }
    },
    
    getShortName(name) {
      if (!name) return 'Usuário';
      const names = name.split(' ');
      const titles = ['Sr.', 'Sra.', 'Srta.', 'Dr.', 'Dra.', 'Prof.', 'Profa.'];
      
      // Remove títulos do início
      let filteredNames = names.filter(n => !titles.includes(n));
      if (filteredNames.length === 0) filteredNames = names; // fallback
      
      return `${filteredNames[0]} ${filteredNames.length > 1 ? filteredNames[1].charAt(0) + '.' : ''}`;
    },
    
    formatDate(dateString) {
      const date = new Date(dateString);
      return date.toLocaleDateString('pt-BR') + ' ' + date.toLocaleTimeString('pt-BR', { hour: '2-digit', minute: '2-digit' });
    },
    
    getProfileImageUrl(url) {
      return PostFeedbackDataService.getImageUrl(url);
    },
    
    async toggleReplyLike(reply) {
      if (!this.isLoggedIn) return;
      
      try {
        const response = await PostFeedbackDataService.toggleReplyLike(reply.id);
        reply.is_liked = response.data.liked;
        reply.likes_count = response.data.likes_count;
      } catch (error) {
        console.error('Erro ao dar like na resposta:', error);
      }
    },
    
    async loadMentionableUsers() {
      try {
        const response = await PostFeedbackDataService.getMentionableUsers(this.productId);
        this.mentionableUsers = response.data.users;
      } catch (error) {
        console.error('Erro ao carregar usuários mencionáveis:', error);
      }
    },
    
    handleReplyInput(event) {
      const value = event.target.value;
      const cursorPos = event.target.selectionStart;
      
      // Verifica se digitou @
      const lastAtIndex = value.lastIndexOf('@', cursorPos - 1);
      if (lastAtIndex !== -1) {
        const textAfterAt = value.substring(lastAtIndex + 1, cursorPos);
        // Só mostra se não tem espaço após @
        if (!textAfterAt.includes(' ') && !textAfterAt.includes('\n')) {
          this.mentionQuery = textAfterAt;
          this.showMentionDropdown = true;
          this.cursorPosition = cursorPos;
          
          // Carrega usuários se ainda não carregou
          if (this.mentionableUsers.length === 0) {
            this.loadMentionableUsers();
          }
        } else {
          this.showMentionDropdown = false;
        }
      } else {
        this.showMentionDropdown = false;
      }
    },
    
    handleKeydown(event) {
      if (event.key === 'Escape') {
        this.showMentionDropdown = false;
      }
      // Fecha dropdown se pressionar espaço após menção
      if (event.key === ' ' && this.showMentionDropdown) {
        this.showMentionDropdown = false;
      }
    },
    
    selectMention(user) {
      const textarea = this.$refs.replyTextarea;
      const value = textarea.value;
      const lastAtIndex = value.lastIndexOf('@', this.cursorPosition - 1);
      
      const beforeMention = value.substring(0, lastAtIndex);
      const afterMention = value.substring(this.cursorPosition);
      
      this.newReply = `${beforeMention}@${user.name} ${afterMention}`;
      this.showMentionDropdown = false;
      
      // Foca no textarea
      this.$nextTick(() => {
        textarea.focus();
        const newPos = beforeMention.length + user.name.length + 2;
        textarea.setSelectionRange(newPos, newPos);
      });
    },
    
    formatReplyWithMentions(text) {
      return text.replace(/@([\w\s]+)/g, '<span class="mention">@$1</span>');
    }
  }
};
</script>

<style scoped>
.main-feedbacks {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: flex-start;
  gap: 15px;
  align-self: stretch;
  padding: 16px;
  border-bottom: 1px solid #f0f0f0;
}

.section-feedback-user-and-photo-and-date {
  display: flex;
  align-items: center;
  gap: 8px;
  align-self: stretch;
}

.feedback-user-and-photo {
  width: 45px;
  height: 45px;
  aspect-ratio: 1/1;
  border-radius: 100px;
  overflow: hidden;
}

.feedback-user-and-photo img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.profile-image {
  border: 2px solid #e10cff;
  border-radius: 50%;
}

.feedback-user-and-date {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: flex-start;
  gap: 8px;
}

.feedback-user-name {
  color: #B33974;
  text-align: center;
  font-family: 'Poppins', sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 500;
  line-height: 120%;
  margin-bottom: -10px;
}

.feedback-user-date {
  color: #B0B0B0;
  text-align: center;
  font-family: 'Poppins', sans-serif;
  font-size: 14px;
  font-style: normal;
  font-weight: 400;
  line-height: 120%;
}

.feedback-stars {
  display: flex;
  align-items: center;
  gap: 5px;
  margin-top: -14px;
}

.feedback-stars img {
  width: 18px;
  height: 18px;
}

.feedback-description {
  align-self: stretch;
}

.feedback-description p {
  color: #757575;
  font-family: 'Poppins', sans-serif;
  font-size: 14px;
  font-style: normal;
  font-weight: 400;
  line-height: 120%;
  margin-top: 8px;
}

.feedback-actions {
  display: flex;
  gap: 16px;
  margin-top: 8px;
}

.like-button, .reply-button {
  display: flex;
  align-items: center;
  gap: 4px;
  background: none;
  border: none;
  color: #757575;
  font-size: 12px;
  cursor: pointer;
  padding: 4px 8px;
  border-radius: 4px;
  transition: all 0.2s;
}

.like-button:hover, .reply-button:hover {
  background-color: #f5f5f5;
}

.like-button.liked {
  color: #E10CFF;
}

.like-button.liked svg {
  color: #E10CFF !important;
}

.like-button.liked svg path {
  fill: #E10CFF !important;
}

.replies-section {
  margin-top: 16px;
  padding-left: 16px;
  border-left: 2px solid #f0f0f0;
}

.reply-form {
  margin-bottom: 16px;
}

.reply-input {
  width: 100%;
  padding: 8px 12px;
  border: 1px solid #ddd;
  border-radius: 8px;
  font-family: 'Poppins', sans-serif;
  font-size: 14px;
  resize: vertical;
  margin-bottom: 8px;
}

.submit-reply-btn {
  background: linear-gradient(90deg, #ED008C 0%, #E10CFF 100%);
  color: white;
  border: none;
  padding: 6px 12px;
  border-radius: 6px;
  font-size: 12px;
  cursor: pointer;
}

.submit-reply-btn:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

.reply-item {
  margin-bottom: 12px;
  padding: 8px;
  background-color: #f9f9f9;
  border-radius: 8px;
}

.reply-header {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 4px;
}

.reply-avatar {
  width: 24px;
  height: 24px;
  border-radius: 50%;
  object-fit: cover;
}

.reply-info {
  display: flex;
  flex-direction: column;
}

.reply-author {
  font-size: 12px;
  font-weight: 500;
  color: #B33974;
}

.reply-date {
  font-size: 10px;
  color: #999;
}

.reply-text {
  font-size: 12px;
  color: #555;
  margin: 0;
  line-height: 1.4;
}

.reply-actions {
  display: flex;
  gap: 8px;
  margin-top: 6px;
}

.reply-like-button {
  display: flex;
  align-items: center;
  gap: 3px;
  background: none;
  border: none;
  color: #999;
  font-size: 10px;
  cursor: pointer;
  padding: 2px 6px;
  border-radius: 3px;
  transition: all 0.2s;
}

.reply-like-button:hover {
  background-color: #f5f5f5;
}

.reply-like-button.liked {
  color: #E10CFF;
}

.reply-like-button.liked svg {
  color: #E10CFF !important;
}

.reply-like-button.liked svg path {
  fill: #E10CFF !important;
}

.reply-input-container {
  position: relative;
}

.mention-dropdown {
  position: absolute;
  bottom: 100%;
  left: 0;
  right: 0;
  background: white;
  border: 1px solid #ddd;
  border-radius: 6px;
  max-height: 120px;
  overflow-y: auto;
  z-index: 1000;
  box-shadow: 0 4px 12px rgba(0,0,0,0.15);
  margin-bottom: 4px;
}

.mention-item {
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 10px 12px;
  cursor: pointer;
  transition: background-color 0.2s;
  border-bottom: 1px solid #f0f0f0;
  font-size: 13px;
}

.mention-item:last-child {
  border-bottom: none;
}

.mention-item:hover {
  background-color: #f8f4ff;
  color: #E10CFF;
}

.mention-avatar {
  width: 20px;
  height: 20px;
  border-radius: 50%;
  object-fit: cover;
}

.mention {
  color: #E10CFF;
  font-weight: 500;
  background-color: #fef7ff;
  padding: 1px 4px;
  border-radius: 3px;
}

.mention-header {
  padding: 6px 12px;
  font-size: 11px;
  color: #999;
  background-color: #f9f9f9;
  border-bottom: 1px solid #f0f0f0;
  font-weight: 500;
}

.mention-no-results {
  padding: 12px;
  text-align: center;
  color: #999;
  font-size: 12px;
  font-style: italic;
}

.like-count-only {
  display: flex;
  align-items: center;
  gap: 4px;
  color: #999;
  font-size: 12px;
}

.reply-like-count-only {
  display: flex;
  align-items: center;
  gap: 3px;
  color: #999;
  font-size: 10px;
}
</style>