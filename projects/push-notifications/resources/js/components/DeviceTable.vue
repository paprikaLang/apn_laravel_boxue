<template>
    <div class="w-100">
        <table v-if="displayTable" class="table table-hover table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">UUID</th>
                    <th scope="col">DEVICE TOKEN</th>
                    <th scope="col">LOCALE</th>
                    <th scope="col">ENVIRONMENT</th>
                    <th scope="col">UPDATED</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="(data, index) in tableData" :key="index">
                    <th scope="row">{{ index + 1 }}</th>
                    <td>{{ data.uuid }}</td>
                    <td>{{ data.token }}</td>
                    <td>{{ data.locale }}</td>
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

export default {
    created() {
        this.fetchTokens();
        window.echo_recv.channel('device.table')
            .listen('DeviceRegistered', (e) => {
                this.tableData.splice(0,0, e.device);
                console.log('ssssssssssssssss');
            });
    },
    data() {
        return {
            tableData: [],
            displayTable: false
        };
    },
    methods: {
        async fetchTokens() {
            try {
                const response = await axios.get("/api/v1/devices");
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
