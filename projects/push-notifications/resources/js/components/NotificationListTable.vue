<template>
    <div class="w-100">
        <table v-if="displayTable" class="table table-hover table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">TITLE</th>
                    <th scope="col">BODY</th>
                    <th scope="col">SOUND</th>
                    <th scope="col">BADGE</th>
                    <th scope="col">ENV</th>
                    <th scope="col">PUSHED AT</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="(data, index) in tableData" :key="data.id">
                    <th scope="row">{{ index + 1 }}</th>
                    <td>{{ data.title }}</td>
                    <td>{{ data.body }}</td>
                    <td>{{ data.sound }}</td>
                    <td>{{ data.badge }}</td>
                    <td>{{ data.environment }}</td>
                    <td>{{ data.updatedAt }}</td>
                </tr>
            </tbody>
        </table>
        <div v-else class="text-black-50" role="status">
            <i class="material-icons">cached</i>&nbsp;&nbsp; Fetching Tokens ...
        </div>
    </div>
</template>

<script>

import axios from "axios";
// import bus from '../eventBus';

export default {
    mounted() {
       this.fetchNotifications();

        bus.$on('notificationPushed', this.fetchNotifications);
    },
    beforeDestroy() {
        bus.$off('notificationPushed', this.fetchNotifications);
    },
    data() {
        return {
            tableData: [],
            displayTable: false
        };
    },
    methods: {
        async fetchNotifications() {
            try {
                const response = await axios.get("/api/v1/notifications");
                this.tableData = response.data.data;
                this.displayTable = true;
                console.log(response);
            } catch (error) {
                console.log(error);
            }
        }
    }
};
</script>

<style></style>
