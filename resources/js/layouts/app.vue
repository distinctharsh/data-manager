<template>
    <v-app>
        <Navbar />
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
import Navbar from "./components/Navbar.vue";

export default {
    name: "App",
    components: {
        Navbar,
    },
};
</script>
