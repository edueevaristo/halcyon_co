<template>
  <main class="main-feedbacks">
    <section class="section-feedback-user-and-photo-and-date">
      <div class="feedback-user-and-photo">
        <img src="@/assets/images/user-feedback-1.svg" alt="Foto de perfil do usuário do feedback">
      </div>

      <div class="feedback-user-and-date">
        <h1 class="feedback-user-name">Amanda Vieira</h1>
        <p class="feedback-user-date">26/03/2025 22:04</p>
      </div>

    </section>

    <section class="feedback-stars">
      <img src="@/assets/icons/star.svg" alt="Estrelas de avaliação">
      <img src="@/assets/icons/star.svg" alt="Estrelas de avaliação">
      <img src="@/assets/icons/star.svg" alt="Estrelas de avaliação">
      <img src="@/assets/icons/star.svg" alt="Estrelas de avaliação">
      <img src="@/assets/icons/star.svg" alt="Estrelas de avaliação">
    </section>

    <section class="feedback-description">
      <p>Eu amo a base da WePink, ela durou umas 8 horas tranquilo na minha pele. A Vírginia sabe o que faz mesmooo rs
        eu peço respeito com as minha maria com a minha familia com a minha virgiia</p>
    </section>
  </main>
</template>

<script>
export default {
  name: 'FeedbackComponent'
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
}
</style>
