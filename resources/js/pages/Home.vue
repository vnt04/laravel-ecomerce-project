<script setup>
import { ref, onMounted } from "vue";
import api from "../api";
import { useRouter } from "vue-router";

const router = useRouter();
const user = ref(null);

onMounted(async () => {
    try {
        const res = await api.get("/user"); // endpoint trả về user từ token
        user.value = res.data;
    } catch {
        router.push("/login");
    }
});

const handleLogout = () => {
    localStorage.removeItem("token");
    router.push("/login");
};
</script>

<template>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-2">Welcome, {{ user?.name }}</h1>
        <button
            @click="handleLogout"
            class="bg-red-500 text-white px-4 py-2 rounded"
        >
            Logout
        </button>
    </div>
</template>
