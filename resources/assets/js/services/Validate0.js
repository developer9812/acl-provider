export default class Validate{
  constructor(){
    this.errorObj = {}
    this.user = {
      "name" : '',
      "username" : '',
      "email" : '',
      "password" : ''
    };
  }

  validateData(formfield, formdata){
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
                      "type" : "string",
                      "minLength" : 6
                  }
           },
           "required": ["username","email","password"],
        // "allOf": [{
        //
        //      "additionalProperties": false
        // }]

        /*"allOf": [
          { "$ref": "#/definitions/userdata"}
        ],
        "definitions": {
          "userdata": {
            "type": "object",
            "properties": {
              "name": {
                          "type": "string",
                          "maxLength": 255,
                          "pattern": "^([a-zA-Z])$"
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
                          "type" : "string",
                          "minLength" : 6
                      }
            },
            "required": ["name","username","email","password"],
            "additionalProperties": false
          }
        }*/
        /*"allOf": [{
              "id": "#name",
              "properties": {
              "name": {
                        "type": "string",
                        "maxLength": 255,
                        "pattern": "^([a-zA-Z])$"
                    }
              },
              "required": ["name"]
          },
          {
              "id": "#username",
              "properties": {
              "username":
                  {
                      "type": "string",
                      "maxLength": 25
                  }
              },
              "required": ["username"]
          },
          {
              "id": "#email",
              "email": {
                      "type": "string",
                      "format": "email",
                      "pattern": "^([a-zA-Z0-9_\-]+)@([a-zA-Z0-9_\-]+)\.([a-zA-Z]{2,5})$",
                      "maxLength": 255
              },
              "required": ["email"]
          },
          {
              "id": "#password",
              "password": {
                    "type" : "string",
                    "minLength" : 6
              },
              "required": ["password"]
          }]*/
    };

    var Ajv = require('ajv');
    var ajv = Ajv();
    // require('ajv-errors')(ajv);
    // ajv.addSchema(defsSchema);
    var validate = ajv.compile(userSchema);
    let valErrors;

    // console.log("FORM DATA");
    // console.log(formdata);

    switch(formfield){
      case 'name': {
        let validData = validate(formdata);
        if (validData) {
          console.log('User data is valid');
      	} else {
          console.log("NAME");
          console.log('User data is INVALID!');
          console.log(validate.errors);
        	// this.errorObj = this.setErrorMessage(true, validate.errors[0].message);
          validate.errors.forEach(err => {
            if (err.dataPath == '.name') this.errorObj = this.setErrorMessage(true, err.message);
          })
          valErrors = validate;
      	}
        break;
      }

      case 'username': {
        let validData = validate({username: formdata.username});
        if(validData) {
          console.log('User data is valid');
      	} else {
          console.log("USERNAME");
          console.log('User data is INVALID!');
          console.log(validate.errors);
          // this.errorObj = this.setErrorMessage(true, validate.errors[1].message);
          validate.errors.forEach(err => {
            if (err.dataPath == '.username') this.errorObj = this.setErrorMessage(true, err.message);
          })
          valErrors = validate;
      	}
        break;
      }

      case 'email' : {
        let validData = validate(formdata);
        if(validData) {
          // console.log(ajv.errorsText(validate.errors));
          console.log('User data is valid');
      	} else {
        	// this.errorObj = this.setErrorMessage(true, validate.errors[2].message);
          validate.errors.forEach(err => {
            if (err.dataPath == '.email') this.errorObj = this.setErrorMessage(true, err.message);
          })
          valErrors = validate;
      	}
        break;
      }
      case 'password' : {
        let validData = validate(formdata);
        if(validData) {
          console.log('User data is valid');
      	} else {
        	console.log('User data is INVALID!');
        	validate.errors.forEach(err => {
            console.log("ERROR");
            if (err.dataPath == '.password') this.errorObj = this.setErrorMessage(true, err.message);
          })
          // this.errorObj = this.setErrorMessage(true, validate.errors[3].message);
          valErrors = validate;
      	}
        break;
      }
    }
    // console.log("VALIDATE");
    // console.log(valErrors);
    // this.isValid();
    return this.errorObj;
  }

  setErrorMessage(isError, errorMsg){
    let error = {
      hasError: isError,
      message: errorMsg
    }
    return error;
  }

  /*isValid(){
      var userSchema = {
  	    "$schema": "http://json-schema.org/schema#",
  	    "id": "http://mynet.com/schemas/user.json#",
  	    "title": "User",
  	    "description": "User profile with connections",
  	    "type": "object",
  	    "properties": {
      		  "name": { "type": "string",
                      "maxLength": 10
                    },
            "username": {
                      "type": "string",
                      "minLength": 5
                    }
    		   }
  	};

    var Ajv = require('ajv');
  	var ajv = new Ajv({allErrors: true});
    var validate = ajv.compile(userSchema);
  	var valid = validate(this.user);

  	if(valid){
      // console.log(ajv.errorsText(validate.errors));
      console.log('User data is valid');
      console.log(valid.message);
  	} else {
    	console.log('User data is INVALID!');
    	console.log(validate.errors);
  	}
  }  */
}
