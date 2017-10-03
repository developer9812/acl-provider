<template lang="html">
  <div v-if="show" class="notification" :class="className">
    <strong v-if="title">{{ title }}</strong>,
    <p v-if="message">{{ message }}</p>
  </div>
</template>

<script>
export default {
  props: {
    show: {
      type: Boolean,
      default: false
    },
    autoClose: {
      type: Boolean,
      default: false
    },
    closeAfter: {
      type: Number,
      default: 3
    },
    level: {
      type: String,
      default: 'info'
    },
    title: {
      type: String,
      default: null
    },
    message: {
      type: String,
      default: null
    }
  },
  computed: {
    className: function(){
      switch (this.level) {
        case 'info':
          return 'is-info';
        case 'success':
          return 'is-success';
        case 'error':
          return 'is-danger';
        case 'warning':
          return 'is-warning';
        default:
          return 'is-primary';
      }
    }
  }
}
</script>

<style lang="scss">
</style>
