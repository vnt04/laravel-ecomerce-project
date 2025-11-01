<template>
  <div class="home">
    <h2>Welcome to Home Page!</h2>
    
    <div class="navigation">
      <el-link href="/product" type="primary">Product</el-link>
      <el-link href="/order" type="primary">Order</el-link>
    </div>

    <el-button type="primary" @click="logout">Logout</el-button>
  </div>
</template>

<script setup>
import api from '../../config/api';


async function logout() {
  try {
    await api('admin/auth/logout', "POST");
    window.location.href = '/login'
  } catch (error) {
    console.error('Lỗi khi đăng xuất:', error)
  }
}

</script>


<style scoped>
.navigation {
  display: flex;
  gap: 20px;
  padding: 20px 0px;
}
</style>
