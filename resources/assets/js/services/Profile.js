export default class Profile {
  static editProfile(id, name){
    console.log("ID => "+id);
    console.log("NAME => "+name);
    return new Promise((resolve, reject) => {
      axios.put('api/profile/personal/'+id+'/'+name)
      .then(response => {
        console.log("PROFILE RESPONSE");
        console.log(response);
        resolve();
      })
      .catch(error => {
        console.log("PROFILE ERROR");
        console.log(error);
        reject();
      });
    });
  }
}
