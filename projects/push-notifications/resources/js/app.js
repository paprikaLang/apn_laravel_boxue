require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
import router from './routes';

Vue.use(VueRouter);

// import DeviceTable from './components/DeviceTable';
// import PushNotificationForm from './components/PushNotificationForm';
// import NotificationListTable from './components/NotificationListTable';

const app = new Vue({
	el: '#app',
	router
});

