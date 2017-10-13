
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
}
