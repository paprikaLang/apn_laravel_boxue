import Notifications from "./components/Notifications";
import Devices from "./components/Devices";
import VueRouter from "vue-router";

export default new VueRouter({
    mode: "history",

    routes: [
        {
            path: "/notifications",
            component: Notifications
        },
        {
            path: "/devices",
            component: Devices
        }
    ]
});
