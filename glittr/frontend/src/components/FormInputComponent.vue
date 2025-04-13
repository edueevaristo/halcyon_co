<template>
  <div class="form-field">
    <div class="field-header">
      <div class="field-label">
        <div class="icon-wrapper" v-html="icon"></div>
        <label :for="id" class="input-label">{{ label }}</label>
      </div>
      <div v-if="forgotPassword" class="forgot-password">
        Esqueci minha senha
      </div>
    </div>
    <input
      :type="type"
      :id="id"
      :placeholder="placeholder"
      class="form-input"
    />
  </div>
</template>

<script>
export default {
  name: "FormInput",
  props: {
    type: {
      type: String,
      default: "text",
    },
    placeholder: {
      type: String,
      required: true,
    },
    label: {
      type: String,
      required: true,
    },
    icon: {
      type: String,
      required: true,
    },
    id: {
      type: String,
      required: true,
    },
    forgotPassword: {
      type: Boolean,
      default: false,
    },
  },
};
</script>

<style scoped>
.form-field {
  display: flex;
  flex-direction: column;
  gap: 8px;
  width: 100%;
  padding: 0;
  margin:0;
}

.field-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: 428px;
}

.field-label {
  display: flex;
  align-items: center;
  gap: 4px;
  justify-content: center;
}

.input-label {
  color: #d4d4d8;
  font-family: Poppins, sans-serif;
  font-size: 14px;
  font-weight: 500;
  line-height: 14px;
}

.forgot-password {
  color: #e10cff;
  font-family: Poppins, sans-serif;
  font-size: 12px;
  font-weight: 400;
  line-height: 16px;
  cursor: pointer;
}

.form-input {
  height: 40px;
  width: 100%;
  border-radius: 14px;
  border-width: 1px;
  border-color: rgba(225, 12, 255, 0.2);
  background-color: rgba(255, 255, 255, 0.05);
  padding: 0 13px;
  color: #64748b;
  font-family: Ubuntu, sans-serif;
  font-size: 14px;
}

.icon-wrapper{
  padding: 0;
  margin-bottom: -6px;
}
</style>
