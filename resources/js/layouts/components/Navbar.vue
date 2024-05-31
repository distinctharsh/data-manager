<template>
    <v-app-bar app>
        <v-toolbar-title>
            <v-btn class="bg-primary" text :to="{ path: '/dashboard' }"
                >Dashboard</v-btn
            >
            <v-btn class="bg-primary ml-5" text :to="{ path: '/upload' }"
                >Upload Data</v-btn
            >
        </v-toolbar-title>
        <v-spacer></v-spacer>
    </v-app-bar>
</template>

<script>
export default {
    name: "Navbar",
};
</script>

<style scoped>
.v-btn {
    color: rgb(237, 0, 0);
}
</style>
