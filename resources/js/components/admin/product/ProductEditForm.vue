<template>
  <el-dialog
    v-model="visible"
    title="Edit Product"
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
      <el-button type="primary" @click="handleSave">Save</el-button>
    </template>
  </el-dialog>
</template>

<script setup>
import { ref, watch, defineEmits, defineProps } from "vue";
import api from "../../../../config/api";


const props = defineProps({
  modelValue: Boolean,
  product: Object,
});
const emit = defineEmits(["update:modelValue", "updated"]);

const visible = ref(props.modelValue);
const form = ref({ ...props.product });

watch(
  () => props.modelValue,
  (val) => (visible.value = val)
);

watch(
  () => props.product,
  (newProduct) => (form.value = { ...newProduct })
);

const handleClose = () => {
  emit("update:modelValue", false);
};

const handleSave = async () => {
  try {
    await api(`admin/products/${form.value.id}`, "PUT", form.value);

    emit("updated");
    handleClose();
  } catch (error) {
    console.error(error);
  }
};
</script>
