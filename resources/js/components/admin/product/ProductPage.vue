<template>
  <section>
    <h2 class="section-name">Product Page</h2>
  </section>

  <section style="margin-bottom: 10px; display: flex; gap: 10px;"> 
    <el-link href="/home" type="primary">Back to Home</el-link>
    <el-button type="primary" size="small" @click="handleAdd">Add Product</el-button>
  </section>

  <!-- Table show list products -->
   <div >
     <el-table :data="products" style="width: 100%">
      <el-table-column fixed prop="name" label="Name" width="250" />
      <el-table-column prop="description" label="Description" width="220" />
      <el-table-column prop="price" label="Price" width="220" />
      <el-table-column prop="stock" label="Stock" width="220" />
      <el-table-column fixed="right" label="Operations" min-width="220">
        <template #default="{row}">
          <el-button link type="primary" size="small" @click="handleClick(row.id)">
            Detail
          </el-button>
          <el-button link type="success" size="small" @click="handleEdit(row)">Edit</el-button>
          <el-button link type="danger" size="small" @click="handleDelete(row.id)">Delete</el-button>
        </template>
      </el-table-column>
     </el-table>
   </div>

   <!-- Form Add -->
  <ProductAddForm 
    v-model="showAddForm"
    @added="fetchProducts"
  />

   <!-- Form Edit -->
  <ProductEditForm
    v-model="showEditDialog"
    :product="selectedProduct"
    @updated="fetchProducts"
  />

  <WarningDelete 
    message="Are you sure to delete this product?" 
    v-model="showDelete" 
    @confirm="deleteProduct"
  />

</template>

<script setup>
import axios from "axios";
import { ref, onMounted } from "vue";
import ProductEditForm from "./ProductEditForm.vue";
import WarningDelete from "../common/Warning.vue";
import ProductAddForm from "./ProductAddForm.vue";
import api from "../../../../config/api";

const products = ref([]);
const productId = ref(null);
const selectedProduct = ref({});

const showAddForm = ref(false);
const showEditDialog = ref(false);
const showDelete = ref(false);

const handleClick = (id) => {
  // go to product detail page
  window.location.href = `product/${id}`;
};

const handleAdd = () => {
  showAddForm.value = true;
}

const handleEdit = (product) => {
  selectedProduct.value = {...product}
  showEditDialog.value = true;
}

const handleDelete = (id) => {
  productId.value = id;
  showDelete.value = true;
}

const deleteProduct = async () => {
  try {
    await api(`admin/products/${productId.value}`, "DELETE");
    await fetchProducts();
  } catch (error) {
    console.error(error);
  }
};

const fetchProducts = async () => {
  try {
    const res = await axios.get("/api/products");
    products.value = res.data.products;
  } catch (error) {
    console.error(error);
  }
};

onMounted(fetchProducts);
</script>

<style scoped>
/* Your styles here */
</style>
