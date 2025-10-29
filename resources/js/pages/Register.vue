<script setup>
import { ref } from "vue";
import api from "../api";
import { useRouter } from "vue-router";

const name = ref("");
const email = ref("");
const password = ref("");
const router = useRouter();
const message = ref("");

const handleRegister = async () => {
    try {
        await api.post("/register", {
            name: name.value,
            email: email.value,
            password: password.value,
        });
        message.value = "Register success! Redirecting...";
        setTimeout(() => router.push("/login"), 1000);
    } catch (err) {
        message.value = "Register failed";
    }
};
</script>

<template>
    <div class="max-w-sm mx-auto mt-20 p-6 border rounded-xl shadow">
        <h1 class="text-xl font-semibold mb-4">Register</h1>
        <div v-if="message" class="text-blue-500 mb-3">{{ message }}</div>

        <input
            v-model="name"
            placeholder="Name"
            class="w-full border p-2 mb-2 rounded"
        />
        <input
            v-model="email"
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
            @click="handleRegister"
            class="bg-green-500 text-white px-4 py-2 rounded w-full"
        >
            Register
        </button>
        <p class="mt-3 text-sm text-center">
            Already have an account?
            <router-link to="/login" class="text-blue-600">Login</router-link>
        </p>
    </div>
</template>
