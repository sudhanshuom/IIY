# IIY

To send notification

1) Add firebase function dependecies
2) FirebaseFunction mFunctions;

call function as

mFunctions
  .getHttpsCallable("sendNotification")
  .call(data)
  .continueWith(new Continuation<HttpsCallableResult, String>() {
      @Override
      public String then(@NonNull Task<HttpsCallableResult> task) throws Exception {
          // This continuation runs on either success or failure, but if the task
          // has failed then getResult() will throw an Exception which will be
          // propagated down.
          String result = (String) task.getResult().getData();
          return result;
      }
  });

All fields are mandatory: token, mesage, title and push

Request Body:

  Map<String, Object> data = new HashMap<>();
  data.put("token", Firebase_token);
  data.put("message", "message that you want to display in notification");
  data.put("title", "your title");
  data.put("push", true);
       
Response :

  "Successfully Sent"
  or
  "error : 'error message'"
