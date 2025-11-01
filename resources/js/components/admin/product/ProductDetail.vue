<template>
  <div>
    <el-link underline href="/product"><--Back to Product</el-link>

    <el-descriptions v-if="data && data.name" :title="data.name" class="item">
      <el-descriptions-item label="Description">{{ data.description }}</el-descriptions-item>
      <el-descriptions-item label="Price">{{ data.price }}</el-descriptions-item>
      <el-descriptions-item label="Stock">
        {{ data.stock }}
      </el-descriptions-item>
    </el-descriptions>
    <div v-else class="no-data">
      <el-empty description="Không có dữ liệu sản phẩm" />
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";  

const data = ref(null);

const props = defineProps({
  productId: {
    type: [String, Number],
    required: true,
  },
});

onMounted(async () => {
  try {
    const res = await axios.get(`/api/products/${props.productId}`);
    data.value = res.data.data;
  } catch (error) {
    console.log(error);
  }
});
</script>

<style scoped>
/* Your styles here */
.item {
  font-weight: bold;
  padding: 10px 50px;
}
.no-data {
  margin-top: 30px;
  text-align: center;
}
</style>
