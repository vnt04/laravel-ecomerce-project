<template>
  <div class="home">
    <h2>Welcome to Home Page!</h2>

    <el-button type="primary" @click="logout">Logout</el-button>
  </div>
</template>

<script setup>
import axios from 'axios'

async function logout() {
  try {
    await axios.post('api/logout')
    window.location.href = '/login'
  } catch (error) {
    console.error('Lỗi khi đăng xuất:', error)
  }
}

</script>

