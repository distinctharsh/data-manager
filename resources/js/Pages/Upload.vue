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
                            @change="validateFile"
                            @click:clear="clearFile"
                        ></v-file-input>
                    </v-col>
                    <v-col>
                        <v-btn
                            color="blue"
                            dark
                            :disabled="!file"
                            @click="handleConfirmation('download')"
                        >
                            Remove duplicates & download
                        </v-btn>
                        <v-btn
                            color="blue"
                            dark
                            class="ml-2"
                            :disabled="!canSaveData"
                        >
                            Save data
                        </v-btn>
                    </v-col>
                </v-row>
            </v-card-item>
        </v-card>

        <!-- Confirmation Dialog -->
        <v-dialog v-model="confirmationDialog" :width="300">
            <v-card class="card-border" elevation="4">
                <v-card-title class="c-title bg-card-head"
                    >Confirmation</v-card-title
                >
                <v-card-text class="pa-5"> Are you sure? </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="danger"
                        type="submit"
                        @click="handleCancelation"
                        >Cancel</v-btn
                    >
                    <v-btn color="#2196f3" @click="handleRemoveSaveData"
                        >Yes</v-btn
                    >
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-container>
</template>

<script>
import axios from "axios";

export default {
    name: "Upload",

    data() {
        return {
            file: null,
            confirmationDialog: false,
            canSaveData: false,
        };
    },

    methods: {
        validateFile(event) {
            this.file = event.target.files[0];
        },

        handleConfirmation(urlType) {
            if (!this.file) {
                alert("please select file first");
                this.urlType = null;
                return;
            }
            this.confirmationDialog = true;
            this.urlType = urlType;
        },

        handleCancelation() {
            this.urlType = null;
            this.clearFile();
            this.confirmationDialog = false;
        },

        async handleRemoveSaveData(e) {
            if (!this.file) {
                alert("Please select file first");
                return;
            }

            console.log(this.urlType);
            let formData = new FormData();
            formData.append("file", this.file);

            try {
                if (this.urlType == "download") {
                    await this.exportData(formData);
                } else {
                    const { data } = await axios.post(
                        `/${this.urlType}`,
                        formData
                    );
                    if (data.success) {
                    } else {
                        console.log(data);
                        alert("Something went wrong");
                    }
                }
            } catch (error) {
            } finally {
                this.urlType = null;
                this.clearFile();
            }
        },

        clearFile() {
            this.file = null;
        },

        async exportData(formData) {
            try {
                const res = await axios.post(`/download`, formData, {
                    responseType: "blob",
                });
                this.canSaveData = true;
                const url = window.URL.createObjectURL(new Blob([res.data]));
                const link = document.createElement("a");
                link.href = url;
                lisk.setAttribute(
                    "download",
                    `clientData-${new Date().getTime()}.xlsx`
                );
                document.body.appendChild(link);
                link.click();
            } catch (e) {
                if (e.response.status == 422)
                    alert("Headings do not match", "red");
            }
        },
    },
};
</script>

<style>
label {
    z-index: 999 !important;
}

input:focus {
    box-shadow: none !important;
}
</style>
