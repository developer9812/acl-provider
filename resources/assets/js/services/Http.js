export default class Http {
  static request(requestType, url, data) {
    let resource = new Promise((resolve, reject) => {
      axios[requestType](url, data)
        .then(response => {
          resolve(response);
        })
        .catch(error => {
          console.log("ERROR");
          console.log(error);
          if (error.response.status == 401) {
            EventBus.$emit('auth-error');
            reject(error);
          } else {
            reject(error);
          }
        })
    });
    return resource;
  }
}
