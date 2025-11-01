<template>
    <el-form @submit.prevent="submitRegister" class="register-form" :model="form" :rules="serverErrors"
        ref="registerForm" label-width="80px" :show-message="true">
      <div class="section-name">Register Page</div>

      <el-form-item label="Name" prop="name">
        <el-input v-model="form.name" placeholder="Nhập tên"></el-input>
        <div class="error-message" v-if="serverErrors.name">{{ serverErrors.name }}</div>
      </el-form-item>

      <el-form-item label="Email" prop="email">
        <el-input v-model="form.email" placeholder="Nhập email"></el-input>
        <div class="error-message" v-if="serverErrors.email">{{ serverErrors.email }}</div>
      </el-form-item>

      <el-form-item label="Mật khẩu" prop="password">
        <el-input v-model="form.password" type="password" placeholder="Nhập mật khẩu"></el-input>
        <div class="error-message" v-if="serverErrors.password">{{ serverErrors.password }}</div>
      </el-form-item>

      <div class="error-message" v-if="serverErrors.error">{{ serverErrors.error }}</div>

      <el-form-item>
        <el-button type="primary" native-type="submit">Đăng nhập</el-button>
      </el-form-item>

      <el-form-item>
        <div style="display: flex; align-items: center; gap: 10px;">
          <h4 style="font-weight: 400; margin: 0; color: gray;">Đã có tài khoản?</h4>
          <el-link underline href="/login">Login page</el-link>
        </div>
      </el-form-item>
    </el-form>

    
</template>


<script setup>
import { reactive, ref } from 'vue';
import axios from 'axios';

const form = reactive({
    name: '',
    email: '',
    password: ''
});

const serverErrors = reactive({
  name: '',
  email: '',
  password: '',
  error:''
});

const registerForm = ref(null);

const submitRegister = async () => {
  serverErrors.name = '';
  serverErrors.email = '';
  serverErrors.password = '';

  try {
    const res = await axios.post('api/admin/auth/register', form);
    window.location.href = '/login';
  } catch (err) {
    if (err.response && err.response.data.errors) {
      const errs = err.response.data.errors;
      for (let key in errs) {
        serverErrors[key] = errs[key].join(', ');
      }
    } else {
      serverErrors.error = err.response?.data.message || 'Register failed';
    }
  } 
}
</script>

<style scoped>
.register-form {
  width: 400px;
  margin: 50px auto;
  padding: 20px 50px;
  background-color: #def0f5;
  border-radius: 5px;
}
</style>   