<template>
  <div class="container-fluid">
    <div class="row mx-2 my-5">
      <div class="col-md-6">
        <push-notification-form></push-notification-form>
      </div>
    </div>
    <div class="row mx-2 my-5">
      <notification-list-table></notification-list-table>
    </div>
  </div>
</template>

<script>
 import PushNotificationForm from './PushNotificationForm';
 import NotificationListTable from './NotificationListTable';

export default {
  components: {
    PushNotificationForm,
    NotificationListTable
  }
};
</script>