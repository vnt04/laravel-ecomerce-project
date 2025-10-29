<script setup>
import { ref } from "vue";
import api from "../api";
import { useRouter } from "vue-router";

const email = ref("");
const password = ref("");
const error = ref("");
const router = useRouter();

const handleLogin = async () => {
    try {
        const res = await api.post("/login", {
            email: email.value,
            password: password.value,
        });
        localStorage.setItem("token", res.data.token);
        router.push("/home");
    } catch (err) {
        error.value = "Invalid credentials";
    }
};
</script>

<template>
    <div class="max-w-sm mx-auto mt-20 p-6 border rounded-xl shadow">
        <h1 class="text-xl font-semibold mb-4">Login</h1>
        <div v-if="error" class="text-red-500 mb-3">{{ error }}</div>

        <input
            v-model="email"
            type="email"
            placeholder="Email"
            class="w-full border p-2 mb-2 rounded"
        />
        <input
            v-model="password"
            type="password"
            placeholder="Password"
            class="w-full border p-2 mb-4 rounded"
        />
        <button
            @click="handleLogin"
            class="bg-blue-500 text-white px-4 py-2 rounded w-full"
        >
            Login
        </button>
        <p class="mt-3 text-sm text-center">
            Don't have an account?
            <router-link to="/register" class="text-blue-600"
                >Register</router-link
            >
        </p>
    </div>
</template>
