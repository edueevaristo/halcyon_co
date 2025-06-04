<template>
  <main class="main-feedbacks">
    <section class="section-feedback-user-and-photo-and-date">
      <div class="feedback-user-and-photo">
        <img
            src="@/assets/images/user-feedback-1.svg"
            :alt="`Foto de perfil de ${shortName}`"
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
  </main>
</template>

<script>
export default {
  name: 'FeedbackComponent',
  props: {
    review: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      starFilledSvg: `
        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M3.64062 13.125L4.65625 8.73438L1.25 5.78125L5.75 5.39062L7.5 1.25L9.25 5.39062L13.75 5.78125L10.3438 8.73438L11.3594 13.125L7.5 10.7969L3.64062 13.125Z" fill="#E10CFF"/>
        </svg>
      `,
      starEmptySvg: `
        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M5.53125 10.5156L7.5 9.32812L9.46875 10.5312L8.95313 8.28125L10.6875 6.78125L8.40625 6.57812L7.5 4.45312L6.59375 6.5625L4.3125 6.76562L6.04688 8.28125L5.53125 10.5156ZM3.64062 13.125L4.65625 8.73438L1.25 5.78125L5.75 5.39062L7.5 1.25L9.25 5.39062L13.75 5.78125L10.3438 8.73438L11.3594 13.125L7.5 10.7969L3.64062 13.125Z" fill="#757575"/>
        </svg>
      `
    }
  },
  computed: {
    shortName() {
      if (!this.review.user?.name) return 'Usuário';
      const names = this.review.user.name.split(' ');
      return `${names[0]} ${names.length > 1 ? names[1].charAt(0) + '.' : ''}`;
    },
    formattedDate() {
      if (!this.review.created_at) return '';
      const date = new Date(this.review.created_at);
      return date.toLocaleDateString('pt-BR') + ' ' + date.toLocaleTimeString('pt-BR', { hour: '2-digit', minute: '2-digit' });
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
</style>