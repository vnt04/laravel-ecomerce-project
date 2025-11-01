<template>
  <el-dialog
    v-model="visible"
    title="Warning"
    width="400"
    align-center
  >
    <div class="dialog-content">
      <span>{{ message }}</span>
    </div>

    <template #footer>
      <div class="dialog-footer">
        <el-button @click="handleClose">Cancel</el-button>
        <el-button type="danger" @click="handleConfirm">Yes</el-button>
      </div>
    </template>
  </el-dialog>
</template>

<script setup>
import { ref, watch, defineEmits, defineProps } from "vue";

const props = defineProps({
  modelValue: Boolean,
  message: {
    type: String,
    default: "Are you sure?",
  },
});

const emit = defineEmits(["update:modelValue", "confirm"]);
const visible = ref(props.modelValue);

const handleConfirm = () => {
  emit("confirm"); 
  handleClose();
};

const handleClose = () => {
  emit("update:modelValue", false);
};

watch(
  () => props.modelValue,
  (val) => (visible.value = val)
);
watch(visible, (val) => {
  emit("update:modelValue", val);
});
</script>

<style scoped>
.dialog-footer {
  display: flex;
  justify-content: flex-end;
  gap: 8px;
}
</style>
