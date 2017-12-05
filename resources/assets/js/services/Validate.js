export default class Validate {
  constructor() {
    this.errorObj = {}
    this.user = {
      "name": '',
      "username": '',
      "email": '',
      "password": ''
    };
  }

  validateData(formfield, formdata) {
    var userSchema = {
      "$schema": "http://json-schema.org/schema#",
      "id": "http://mynet.com/schemas/user.json#",
      "title": "User",
      "description": "User profile with connections",
      "type": "object",

      "properties": {
        "name": {
          "type": "string",
          "maxLength": 255,
          "pattern": "^[a-zA-Z]"
        },
        "username": {
          "type": "string",
          "maxLength": 25
        },

        "email": {
          "type": "string",
          "format": "email",
          "pattern": "^([a-zA-Z0-9_\-]+)@([a-zA-Z0-9_\-]+)\.([a-zA-Z]{2,5})$",
          "maxLength": 255
        },
        "password": {
          "type": "string",
          "minLength": 6
        }
      },
      "required": ["name","username"],
      "errorMessage": {
        "type": "should be an object",
        "required": {
          "name": "Name is required",
          "username": "Username is required"
        }
      }
    };

    var Ajv = require('ajv');
    var ajv = Ajv({allErrors: true, jsonPointers: true});
    require('ajv-errors')(ajv, { singleError: true});
    var validate = ajv.compile(userSchema);
    let valErrors;

    switch (formfield) {
      case 'name':
        {
          let validData = validate(formdata);
          if (validData) {
            console.log('User data is valid');
          } else {
            validate.errors.forEach(err => {
              if (err.dataPath == '.name')
                this.errorObj = this.setErrorMessage(true, err.message);
              }
            )
            valErrors = validate.errors;
          }
          break;
        }

      case 'username':
        {
          let validData = validate({username: formdata.username});
          if (validData) {
            console.log('User data is valid');
          } else {
            validate.errors.forEach(err => {
              if (err.dataPath == '.username')
                this.errorObj = this.setErrorMessage(true, err.message);
              }
            )
            valErrors = validate.errors;
          }
          break;
        }

      case 'email':
        {
          let validData = validate(formdata);
          if (validData) {
            console.log('User data is valid');
          } else {
            validate.errors.forEach(err => {
              if (err.dataPath == '.email')
                this.errorObj = this.setErrorMessage(true, err.message);
              }
            )
            valErrors = validate.errors;
          }
          break;
        }
      case 'password':
        {
          let validData = validate(formdata);
          if (validData) {
            console.log('User data is valid');
          } else {
            validate.errors.forEach(err => {
              if (err.dataPath == '.password')
                this.errorObj = this.setErrorMessage(true, err.message);
              }
            )
            valErrors = validate.errors;
          }
          break;
        }
    }
    // console.log("VALIDATE");
    console.log(valErrors);
    // this.isValid();
    return this.errorObj;
  }

  setErrorMessage(isError, errorMsg) {
    let error = {
      hasError: isError,
      message: errorMsg
    }
    return error;
  }
}
