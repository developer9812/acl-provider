
/**
 * Service for Authentication Helper
 */
export default class Auth {

  /**
   * Checks authentication status
   * @return {Promise}
   */
  static isAuthenticated(){
    return new Promise((resolve, reject) => {
      axios.get('/api/user/status')
        .then(response => {
          console.log("AUTH STATUS");
          console.log(response);
          if (response.status) {
            this.setPermissions()
            .then(() => {
              resolve(true);
            })
            .catch(() => {
              resolve(false);
            })
          } else {
            resolve(false);
          }
        })
        .catch(error => {
          console.log("ERROR");
          console.log(error);
          resolve(false);
        })
    })
  }

  /**
   * Fetch permissions for user and store them in localstorage
   * @return {Promise}
   */
  static setPermissions(){
    return new Promise((resolve, reject) => {
      axios.get('/api/user/permissions')
        .then(response => {
          console.log(response.data);
          let permissions = [];
          localStorage.setItem('role', JSON.stringify(response.data));
          for(let i = 0; i < response.data.length; i++) {
            console.log(response.data[i]);
            let rolePermissions = response.data[i].permissions;
            for(let j = 0; j < rolePermissions.length; j++) {
              if(!permissions.includes(rolePermissions[j].name)){
                permissions.push(rolePermissions[j].name);
              }
            }
          }
          localStorage.setItem('permissions', JSON.stringify(permissions));
          resolve();
        })
        .catch(error => {
          console.log("PERMISSION ERROR");
          console.log(error);
          reject();
        })
    })
  }

  static login(form){
    return new Promise((resolve, reject) => {
      axios.post('/login',form)
      .then(response => {
        console.log(response);
        resolve();
        // let path = this.$store.getters.intendedPath;
        // console.log("PATH => "+path);
        // this.$store.commit('setIntendedPath', '/');
        // setPermissions();
        // this.$router.push(path);
      })
      .catch(error => {
        console.log("ERROR");
        // this.setError(error);
        console.log(error);
        reject(error);
      })
    });
  }

  static logout(){
    // location.reload();
    localStorage.setItem('role','');
    localStorage.setItem('permissions','');
    /*axios.post('/logout')
      .then(response => {
        console.log("MAIN RESPONSE");
        console.log(response);
        localStorage.setItem('role','');
        localStorage.setItem('permissions','');
        // location.reload();
        // this.$store.commit('intendedPath', '/');
        // this.$router.push({name: 'login'});
      })
      .catch(error => {
        console.log("ERROR");
        console.log(error);
        // location.reload();
      })*/
  }

}
