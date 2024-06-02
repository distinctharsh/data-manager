<template>
    <v-app>
        <Navbar v-if="isAuthenticated" />
        <v-main>
            <router-view v-slot="{ Component, route }">
                <div :key="route.name">
                    <component :is="Component" />
                </div>
            </router-view>
        </v-main>
    </v-app>
</template>

<script>
import Navbar from "../components/Navbar.vue";
import { store } from "../store"; // Adjust the path as necessary

export default {
    name: "App",
    components: {
        Navbar,
    },
    computed: {
        isAuthenticated() {
            return store.isAuthenticated();
        },
    },
};
</script>
