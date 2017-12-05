
export default class Validate{
  constructor(){
    this.errorObj = {}
  }
  validateData(formfield, formdata){
    console.log('FORMFIELD => '+formfield);
    switch(formfield){
      case 'name': {
        if(formdata === ''){
          this.errorObj = this.setErrorMessage(true, 'name is required.');
          // this.isError = true;
          // msg = 'name is required';
        }else if (formdata.length < 6){
          this.errorObj = this.setErrorMessage(true, 'name is too short.');
          // this.isError = true;
          // msg = 'name is too short.';
        }else if(formdata.match('^[0-9]*$')){
          this.errorObj = this.setErrorMessage(true, 'name requires only characters.');
          // this.isError = true;
          // msg = 'name requires only characters';
        }else{
          this.errorObj = this.setErrorMessage(false, '');
          // this.isError = false;
        }
        break;
      }

      case 'username': {
        if(formdata === ''){
          this.errorObj = this.setErrorMessage(true, 'username is required.');
          // this.isError = true;
          // msg = 'name is required';
        }else if(formdata.length < 6){
          this.errorObj = this.setErrorMessage(true, 'username is too short.');
          // this.isError = true;
          // msg = 'name is too short.';
        }else if(formdata.match('^[0-9]*$')){
          this.errorObj = this.setErrorMessage(true, 'username requires only characters.');
          // this.isError = true;
          // msg = 'name requires only characters';
        }else{
          this.errorObj = this.setErrorMessage(false, '');
          // this.isError = false;
        }
        break;
      }
    }
    return this.errorObj;
  }

  setErrorMessage(isError, errorMsg){
    let error = {
      hasError: isError,
      message: errorMsg
    }
    return error;
  }
}
