<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title></title>
    <meta name="author" content="" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<style>
body {font-family: Arial, Helvetica, sans-serif; }

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #ebcc34;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}


.container {
  padding: 16px;
  text-align: center;
    margin: auto;
  /*position: absolute;
  left:765px;
  top: 350px;*/
  background-color: #edece4; 
  border-radius: 10px 10px 10px;
}



span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
  </head>
  <body>
    <div id="app"> 
    
      <div class="container" style="height: 250px;width:350px;border: 1px solid #d9d9d9;">

        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Name" id='uname' v-model='usrname' required>

        <label for="psw"><b>Password</b></label>
        <input type="text" placeholder="Enter Room Id" id='usrpassword' v-model='usrpassword' required>


        <button v-on:click="joinbtn">login</button>

      </div>
    </div>



    <div
      style="display: flex; flex-direction: column; flex: 1; justify-content: center; align-items: center; width: 100%; height: 100%"
    >
      <h1>Client Website!!</h1>
      <button
        style="height: 2rem;width: 20rem;background: beige;border: 1px solid black; margin-top: 2rem;"
        onclick="clickMe()"
      >
        Quick Transfer
      </button>

      <button
        style="height: 2rem;width: 20rem;background: beige;border: 1px solid black; margin-top: 2rem;"
        onclick="clickMe2()"
      >
        asd
      </button>
    </div>
    <script src="js/ajax.js"></script>
   <script src="https://cdn.dapi.co/dapi/v2/sdk.js"></script>
    <script>
      let connectLoading = true
      var ba = null
      
      var dapi = Dapi.create({
          environment: Dapi.environments.sandbox,
          appKey: "5401aabaedb799e786d5ec56a53809c695c94f0a15f6db5e6aaed533ca733382",
          countries: ["AE"],
          bundleID: "http://localhost/digitalbank/",
          clientUserID: "tuazonjonathan04@yahoo.com",
          isCachedEnabled: true,
          isExperimental: false,
          clientHeaders: {},
          clientBody: {},
          onSuccessfulLogin: function(bankAccount) {
            ba = bankAccount;
          },
          onFailedLogin: function(err) {
            if (err != null) {
              console.log("Error");
              console.log(err);
            } else {
              console.log("No error");
            }
          },
          onReady: function() {
            connectLoading = false
          },
        });
      var clickMe = function() {
          if (!connectLoading){
            dapi.open();
          } else {
              console.error("Widget is loading. Please wait!")
          }
      };

      function clickMe2() {
          $.ajax({
            //url: '[POST] https://api.dapi.co/v2/apps/sandbox/CreateUser',
            "url": "https://api.dapi.co/v2/apps/sandbox/GetAllUsers",
            "method": "POST",
            "timeout": 0,
            "headers": {
              "Content-Type": "application/json",
              "Authorization"
            },
           // "data": JSON.stringify({"appKey":"5401aabaedb799e786d5ec56a53809c695c94f0a15f6db5e6aaed533ca733382","username":"jet","password":"password1","bankID":"DAPIBANK_AE_ADIB"}),
             "data": JSON.stringify({"appKey":"5401aabaedb799e786d5ec56a53809c695c94f0a15f6db5e6aaed533ca733382"}),
            success:function(data)
            {
               console.log(data);
            }
        });

      };

   
    </script>
  </body>
</html>