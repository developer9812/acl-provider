<template lang="html">
  <div class="container">
    <div class="section">
      <div class="columns is-multiline">
        <div class="column is-4">
          <div class="box" @click="redirectSiteServer">
            <div class="columns">
              <div class="column is-narrow">
                <p><i class="fa fa-graduation-cap app-logo"></i></p>
              </div>
              <div class="column">
                <div class="content">
                  <p class="title is-3">Site Server</p>
                  <p class="subtitle is-6">Global Web Server</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="column is-4">
          <div class="box">
            <div class="columns">
              <div class="column is-narrow">
                <p><i class="fa fa-graduation-cap app-logo"></i></p>
              </div>
              <div class="column">
                <div class="content">
                  <p class="title is-3">Asset Creator</p>
                  <p class="subtitle is-6">Create and manage exercises</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="column is-4">
          <div class="box">
            <div class="columns">
              <div class="column is-narrow">
                <p><i class="fa fa-graduation-cap app-logo"></i></p>
              </div>
              <div class="column">
                <div class="content">
                  <p class="title is-3">Product Creator</p>
                  <p class="subtitle is-6">Create and manage products</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="column is-4">
          <div class="box">
            <div class="columns">
              <div class="column is-narrow">
                <p><i class="fa fa-key app-logo"></i></p>
              </div>
              <div class="column">
                <div class="content">
                  <p class="title is-3">Licensor</p>
                  <p class="subtitle is-6">Manage Site licenses</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    redirectSiteServer: function(){
      window.location.href = 'http://192.168.1.66:5012/siteserver/' + this.$store.getters.username;
      // axios.get('http://192.168.1.66:5012/siteserver/' + this.$store.getters.username)
      // .then(response => {
      //   console.log(response);
      //   window.location.href = response;
      // })
      // .catch(error => {
      //
      // })
    }
  }
}
</script>

<style lang="scss" scoped>
.app-logo{
  font-size: 3rem;
}
i{
  transition: all 0.3s ease;
}
.box{
  .title{
    opacity: .8;
    transition: all 0.3s ease;
  }
  .subtitle{
    opacity: 0.6;
    transition: all 0.3s ease;
  }
  &:hover{
    color: rgba(227, 74, 26, 0.88);
    cursor: pointer;
    .title{
      opacity: 1;
    }
    .subtitle{
      opacity: 1;
    }
  }
}
</style>
