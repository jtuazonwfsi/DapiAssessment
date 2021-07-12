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
      
      <div class="container" style="height: 380px;width:350px;border: 1px solid #d9d9d9;">
        <h2>Connect To sandbox</h2>
        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Name" id='uname' v-model='usrname' value='tuazonjonathan04@yahoo.com' required>

        <label for="psw"><b>Password</b></label>
        <input type="text" placeholder="Enter Password" id='usrpassword' v-model='usrpassword' value='Dynamics1220' required>

        <label for="bnk"><b>Bank</b></label>
        <select value=""name ="OTtype" id="usrbank" v-model='usrbank' style="width:100%;height: 35px;" required="required">
                <option value=""></option>
                <option value="DAPIBANK_AE_ADIB">ADIB Bank</option>
                <option value="DAPIBANK_AE_EIB">EIB Bank</option>
                <option value="DAPIBANK_AE_ENBD">ENBD Bank</option>
                <option value="DAPIBANK_AE_LIV">Liv Bank</option>
                <option value="DAPIBANK_AE_SCHRTD">Standard Chartered Bank</option>
        </select>


        <button v-on:click="createbtn">Register</button>
        <button v-on:click="signbtn">Sign-in</button>

      </div>
    </div>


<script>

    window.onload=function(){
    var auth = localStorage.getItem("auth");
    console.log(auth);

}
     
var joinapp = new Vue({
  el: '#app',
  data: {
        usrname:"",
        usrpassword:"",
        usrbank:"",
        auth:localStorage.getItem("auth")
  },
   
    methods: {
        createbtn: function(){
          if(this.usrname != '' && this.usrpassword != '' && this.usrbank){

            axios.post('https://api.dapi.co/v2/apps/sandbox/CreateUser', {
              appKey:'98ba5f2e7dbee258daa7628431afaf680cb7ed48a95c553ea3d24846854e75fe', 
              username:this.usrname,
              password:this.usrpassword,
              bankID:this.usrbank,
              },{
                headers: {
                    'Authorization': 'Bearer '+this.auth, 
                    'Content-Type': 'application/json'
              }
             
            })
            .then(function(response){
              console.log(response.data);
            })
            .catch(function (error) {
              console.log(error);
            });
          }
          else
          {
            alert("Fill All Field");
          }
          
        },
        signbtn: function(){
            window.location.href='bank.php';
        }
    }

})

   
    </script>
  </body>
</html>



