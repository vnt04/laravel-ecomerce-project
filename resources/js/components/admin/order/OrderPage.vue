<template>
  <section>
    <h2 class="section-name">Order Page</h2>
  </section>

  <section style="margin-bottom: 10px; display: flex; gap: 10px;"> 
    <el-link href="/home" type="primary">Back to Home</el-link>
  </section>

  <!-- Table show list orders -->
   <el-table :data="orders" style="width: 100%">
    <el-table-column prop="id" label="ID" width="100" />
    <el-table-column prop="customer_id" label="Customer ID" width="120" />
    <el-table-column prop="total" label="Total Price" width="150" />

    <!-- Cột status -->
    <el-table-column prop="status" label="Status" width="160">
      <template #default="{ row }">
        <el-tag :type="statusTagType(row.status)" size="small">
          {{ row.status }}
        </el-tag>
      </template>
    </el-table-column>

    <!-- Cột created_at -->
    <el-table-column prop="created_at" label="Order Date" width="220">
      <template #default="{ row }">
        {{ formatDate(row.created_at) }}
      </template>
    </el-table-column>

    <!-- Các hành động -->
    <el-table-column fixed="right" label="Operations" min-width="220">
      <template #default="{row}">
        <el-button link type="primary" size="small" @click="handleClick(row.id)">Detail</el-button>
        <el-button link type="success" size="small" @click="handleConfirm(row.id)">Confirm</el-button>
        <el-button link type="danger" size="small" @click="handleCancel(row.id)">Cancel</el-button>
      </template>
    </el-table-column>
  </el-table>

  <Warning 
    v-model="showWarningConfirm" 
    message="Are you sure to change status this order to CONFIRMED"
    @confirm="updateStatusToConfirmed"/>

  <Warning 
    v-model="showWarningCancel" 
    message="Are you sure to change status this order to CANCELLED"
    @confirm="updateStatusToCanceled"/>
</template>

<script setup>
import { onMounted, ref } from "vue";
import api from "../../../../config/api";
import { statusTagType, formatDate } from "../../../ultils/helper";
import Warning from "../common/Warning.vue";


const orders = ref(null);

const showWarningConfirm = ref(false);
const showWarningCancel = ref(false);
const orderId = ref(null);

const handleClick = (id) => {
  window.location.href = `order/${id}`;
}

const handleConfirm = (id) => {
  orderId.value = id;
  showWarningConfirm.value = true;
}

const handleCancel = (id) => {
  orderId.value = id;
  showWarningCancel.value = true;
}

const updateStatusToConfirmed = async () => {
  try {
    await api(`admin/orders/${orderId.value}/confirm`, "PUT");
    await fetchOrders();
  } catch (error) {
    console.log(error);
  }
}

const updateStatusToCanceled = async () => {
  try {
    await api(`admin/orders/${orderId.value}/cancel`, "PUT");
    await fetchOrders();
  } catch (error) {
    console.log(error);
  }
}

const fetchOrders = async () => {
  try {
    const res = await api("admin/orders");
    orders.value = res.data.orders;
  } catch (error) {
    console.log(error);
  }
}
onMounted(fetchOrders);
</script>

<style scoped>
/* Your styles here */
</style>
