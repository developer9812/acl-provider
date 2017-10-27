class Permission{
  static hasPermission(name) {
    if (localStorage.getItem('permissions')){
      let permissions = JSON.parse(localStorage.getItem('permissions'));
      if (permissions.includes(name)) {
        return true;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }
}

export default Permission;
