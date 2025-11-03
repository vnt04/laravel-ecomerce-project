<template>
  <section>
    <h1>Order details with ID: {{ props.orderId }}</h1>
  </section>
</template>

<script setup>
import { ref } from "vue";

const data = ref(null);

const props = defineProps({
  orderId: {
    type: [String, Number],
    required: true,
  }
})
</script>

<style scoped>
/* Your styles here */
</style>
