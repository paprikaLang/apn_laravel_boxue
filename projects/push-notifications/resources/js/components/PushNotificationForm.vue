<template> 
<div>
  <form v-on:submit.prevent='onSubmit'>
    <div class="form-group">
      <label for="title"><strong>Title</strong></label>
      <input type="text" class="form-control" v-model="form.title" placeholder="Enter title">
    </div>
    <div class="form-group">
      <label for="body"><strong>Body</strong></label>
      <input type="text" class="form-control" v-model="form.body" placeholder="Message Body">
    </div>
    <div class="form-group">
      <label for="badge"><strong>Badge</strong></label>
      <input type="text" class="form-control" v-model="form.badge" placeholder="ENTER Badge">
    </div>
    <div class="row">
      <div class="col">
          <div class="form-group">
            <label for="sound"><strong>Sound</strong></label>
            <select class="form-control" v-model="form.sound">
              <option v-for="sound in soundOptions" :value="sound.value" :key="sound.value">
                {{sound.label}}
              </option>
            </select>
          </div>
      </div>
      <div class="col">
          <div class="form-group">
            <label for="locale"><strong>locale</strong></label>
            <select class="form-control" v-model="form.locale">
              <option v-for="locale in localeOptions" :value="locale.value" :key="locale.value">
                {{locale.label}}
              </option>
            </select>
          </div>
      </div>
      <div class="col">
          <div class="form-group">
            <label for="environment"><strong>environment</strong></label>
            <select class="form-control" v-model="form.environment">
              <option v-for="environment in environmentOptions" :value="environment.value" :key="environment.value">
                {{environment.label}}
              </option>
            </select>
          </div>
      </div>
    </div>
    <button type="submit" class="btn btn-primary px-2"><strong>Push Notification</strong></button>
  </form>
  <button  @click="clearform" class="btn btn-primary px-2"><strong>clear</strong></button>
  </div>
</template>

<script>
import axios from 'axios';
// import bus from '../eventBus';
export default {
  data() {
    return {
      soundOptions: [
        {
          value: 1,
          label: 'system default'
        },
        {
          value: 2,
          label: 'jingle bells'
        }
      ],
      localeOptions: [
        {
          value: 1,
          label: 'default (CN)'
        },
        {
          value: 2,
          label: 'english (EN)'
        }
      ],
      environmentOptions: [
        {
          value: 1,
          label: "Production"
        },
        {
          value: 2,
          label: 'Development'
        }
      ],
      form: {
        title: '',
        body: '',
        badge: 0,
        sound: 1,
        locale: 1,
        environment: 1
      }
    };
  },
  methods: {
    clearform() {
      this.form.title = '';
      this.form.body = '';
      this.form.badge = 0;
      this.form.sound = 1;
      this.form.locale = 1;
      this.form.environment = 1;
    },
    async onSubmit() {
      try {
        const response  = await axios.post('/api/v1/notifications', this.form);
        bus.$emit('notificationPushed');
      }catch( error){
        console.log(error);
      }
    }
  }
}
</script>