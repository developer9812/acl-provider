
/**
 * Service for Authentication Helper
 */
export default class Auth {

  /**
   * Checks authentication status
   * @return {Boolean}
   */
  static isAuthenticated(){
    return new Promise((resolve, reject) => {
      axios.get('/api/user/status')
        .then(response => {
          console.log("AUTH STATUS");
          console.log(response);
          if (response.status) {
            resolve(true);
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

  static setPermissions(){
    return new Promise((resolve, reject) => {
      axios.get('/user/permissions')
        .then(response => {
          console.log(response.data);
          let permissions = [];
          localStorage.setItem('role', JSON.stringify(response.data));
          for(let i = 0; i < response.data.length; i++) {
            console.log(response.data[i]);
            let rolePermissions = response.data[i].permissions;
            for(let j = 0; j < rolePermissions.length; j++) {
              if (!permissions.includes(rolePermissions[j].name)){
                permissions.push(rolePermissions[j].name);
              }
            }
          }
          localStorage.setItem('permissions', JSON.stringify(permissions));
        })
        .catch(error => {
          console.log("PERMISSION ERROR");
          console.log(error);
        })
    })
  }
}
