<template>
  <el-dialog
    v-model="visible"
    title="Add new Product"
    width="500"
    @close="handleClose"
  >
    <el-form :model="form" label-width="100px">
      <el-form-item label="Name">
        <el-input v-model="form.name" />
      </el-form-item>

      <el-form-item label="Description">
        <el-input v-model="form.description" />
      </el-form-item>

      <el-form-item label="Price">
        <el-input v-model="form.price" type="number" />
      </el-form-item>

      <el-form-item label="Stock">
        <el-input v-model="form.stock" type="number" />
      </el-form-item>
    </el-form>

    <template #footer>
      <el-button @click="handleClose">Cancel</el-button>
      <el-button type="primary" @click="handleAdd">Save</el-button>
    </template>
  </el-dialog>
</template>

<script setup>
import { ref, watch, defineEmits, defineProps } from "vue";
import api from "../../../../config/api";

const props = defineProps({
  modelValue: Boolean,
});
const form = ref({
  name:'',
  description: '',
  price: '',
  stock: ''
});

const emit = defineEmits(["update:modelValue", "added"]);

const visible = ref(props.modelValue);

watch(
  () => props.modelValue,
  (val) => (visible.value = val)
);

const handleClose = () => {
  emit("update:modelValue", false);
}

const handleAdd = async () => {
  try {
    await api(`admin/products/`, "POST",form.value);
    emit("added");
    handleClose();
  } catch (error) {
    console.log(error);
  }
}
const data = ref(null);
</script>

<style scoped>
/* Your styles here */
</style>
