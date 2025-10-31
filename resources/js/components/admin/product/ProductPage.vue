<template>
  <section>
    <h2 class="section-name">Product Page</h2>
  </section>

  <!-- Table show list products -->
   <div class="container">
     <el-table :data="products" style="width: 100%">
      <el-table-column fixed prop="name" label="Name" width="250" />
      <el-table-column prop="description" label="Description" width="220" />
      <el-table-column prop="price" label="Price" width="220" />
      <el-table-column prop="stock" label="Stock" width="220" />
      <el-table-column fixed="right" label="Operations" min-width="220">
        <template #default>
          <el-button link type="primary" size="small" @click="handleClick">
            Detail
          </el-button>
          <el-button link type="primary" size="small">Edit</el-button>
        </template>
      </el-table-column>
     </el-table>
   </div>
</template>

<script setup>
import axios from "axios";
import { ref, onMounted } from "vue";

const products = ref([]);

const handleClick = () => {
  console.log("click");
};

onMounted(async () => {
  try {
    const res = await axios.get("/api/products");
    products.value = res.data.products;
  } catch (error) {
    console.log(error);
  }
});
</script>

<style scoped>
/* Your styles here */
</style>
