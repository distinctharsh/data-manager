<!-- src/views/Upload.vue -->
<template>
    <v-container class="p-6 text-gray-900">
        <v-card class="mx-auto" variant="elevated">
            <v-card-item>
                <v-row class="mt-2">
                    <v-col cols="">
                        <v-file-input
                            label="Upload Excel Sheet"
                            variant="outlined"
                            density="compact"
                        ></v-file-input>
                    </v-col>
                    <v-col>
                        <v-btn color="blue" dark>
                            Remove duplicates & download
                        </v-btn>
                        <v-btn color="blue" dark class="ml-2">
                            Save data
                        </v-btn>
                    </v-col>
                </v-row>
            </v-card-item>
        </v-card>
    </v-container>
</template>

<script>
export default {
    name: "Upload",
};
</script>
