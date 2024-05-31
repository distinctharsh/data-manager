<template>
    <div>
        <h1>HOME</h1>
        <!-- <router-link to="/test">Take me to Test page</router-link> -->
        <button @click="getValue">Trigger Endpoint</button>
        <p v-if="response">{{ response.message }}</p>
    </div>
</template>

<script setup>
import axios from "axios";
import { ref } from "vue";

const response = ref(null);

const getValue = async () => {
    console.log("Button clicked");
    try {
        const res = await axios.get("/api/test-me");
        console.log("Response received:", res.data);
        response.value = res.data;
    } catch (error) {
        console.error("Error:", error);
    }
};
</script>
