
<template>
    <el-form @submit.prevent="submitLogin" class="login-form" :model="form" :rules="serverErrors"
        ref="loginForm" label-width="80px" :show-message="true">
      <div class="section-name">Login Page</div>
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
          <h4 style="font-weight: 400; margin: 0; color: gray;">Chưa có tài khoản?</h4>
          <el-link underline href="/register">Register page</el-link>
        </div>
      </el-form-item>
       
      
      
    </el-form>
</template>

<script setup>
import { reactive, ref } from 'vue';
import axios from 'axios';

const form = reactive({
    email: '',
    password: ''
});

const serverErrors = reactive({
  email: '',
  password: '',
  error:''
});

const loginForm = ref(null);

const submitLogin = async () => {
  
  serverErrors.email = '';
  serverErrors.password = '';

  try {
    const res = await axios.post('api/login', form);
    window.location.href = '/home';
  } catch (err) {
    console.log(err);
    if (err.response && err.response.data.errors) {
      const errs = err.response.data.errors;
      for (let key in errs) {
        serverErrors[key] = errs[key].join(', ');
      }
    } else {
      serverErrors.error = err.response?.data.message || 'Login failed';
    }
  } 
};


</script>

<style scoped>
.login-form {
  width: 400px;
  margin: 50px auto;
  padding: 20px 50px;
  background-color: #f7eeee;
  border-radius: 5px;
}



</style>   