'use-strict'

const functions = require('firebase-functions');
const admin = require('firebase-admin');
admin.initializeApp(functions.config().firebase);

exports.sendNotification = functions.https.onCall((data, context) => {
  // ...
  const token = data.token;
  const msg = data.message;
  const title = data.title;
  console.log("Hello : " + token);
  console.log("msg : " + msg);
  console.log("title : " + title);

  if(typeof(token) === 'undefined')
    return "token missing";

  else if(typeof(msg) === 'undefined')
    return "message missing";

  else if(typeof(title) === 'undefined')
    return "title missing";

  else{
      const payload = {
  				"data": {
  		    "title": title,
  		    "body": msg,
  		    }
  			};

      return admin.messaging().sendToDevice(token, payload)
                      .then((response) => {
                          console.log("Successfully sent message:", response);
                          return  "Successfully sent";
                      })
                      .catch((error) => {
                          console.log("Error sending message:", error);
                          return "error : " + error.toString();
                      });
    }

});
