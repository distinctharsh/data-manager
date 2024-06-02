<template>
    <v-container class="fill-height" fluid>
        <v-row justify="center" align="center">
            <v-col cols="12" sm="8" md="4">
                <v-card>
                    <v-card-title class="headline">Login</v-card-title>
                    <v-card-text>
                        <v-form @submit.prevent="login">
                            <v-text-field
                                v-model="email"
                                label="Email"
                                type="email"
                                required
                            ></v-text-field>
                            <v-text-field
                                v-model="password"
                                label="Password"
                                type="password"
                                required
                            ></v-text-field>
                            <v-btn type="submit" color="primary" block
                                >Login</v-btn
                            >
                        </v-form>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import { store } from "../store";

export default {
    name: "Login",
    data() {
        return {
            email: "",
            password: "",
        };
    },
    methods: {
        login() {
            // Add your login logic here
            // For example, set a token in localStorage
            if (this.email && this.password) {
                // Simulate an API call to authenticate the user
                localStorage.setItem("user", "authenticated");
                store.setUser({ email: this.email }); // Set user in the store
                this.$router.push("/dashboard");
            } else {
                alert("Please fill in both fields.");
            }
        },
    },
};
</script>

<style scoped>
.fill-height {
    height: 100vh;
}
</style>
