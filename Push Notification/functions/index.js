'use-strict'

const functions = require('firebase-functions');
const admin = require('firebase-admin');
admin.initializeApp(functions.config().firebase);

exports.sendNotification = functions.https.onCall((data, context) => {
  // ...
  const token = data.text;
  const msg = data.message;
  const title = data.title;
  console.log("Hello  :   "+token);

  const payload = {
				"data": {
		    "title": title,
		    "body": msg,
		    }
			};

    return admin.messaging().sendToDevice(token, payload)
                    .then((response) => {
                        console.log("Successfully sent message:", response);
                        return  "a";
                    })
                    .catch((error) => {
                        console.log("Error sending message:", error);
                        return "b";
                    });

});
