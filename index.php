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
      
      <div class="container" style="height: 300px;width:350px;border: 1px solid #d9d9d9;">
        <h2>Connect To sandbox</h2>
        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Name" id='uname' v-model='usrname' value='tuazonjonathan04@yahoo.com' required>

        <label for="psw"><b>Password</b></label>
        <input type="text" placeholder="Enter Room Id" id='usrpassword' v-model='usrpassword' value='Dynamics1220' required>


        <button v-on:click="joinbtn">Connect</button>

      </div>
    </div>

    </div>

    <script>
      

  var joinapp = new Vue({
  el: '#app',
  data: {
        usrname:"tuazonjonathan04@yahoo.com",
        usrpassword:"Dynamics1220"
  },
   
  methods: {
    joinbtn: function(){
      if(this.usrname != '' && this.usrpassword != ''){
        
       /* axios.post('https://api.dapi.co/v2/clients/ClientLogin/password', {
          username: this.usrname,
          password: this.usrpassword,
        }, {
          header: {
            
            "Content-Type": "application/json",
          },
          timeout: 10000
        })
        .then(function(response){
          console.log(response.data.message);
          
        });*/

        axios.post('https://api.dapi.co/v2/clients/ClientLogin/password', {
          email:this.usrname, 
          password:this.usrpassword,
          },{
        header: {
            "Content-Type": "application/json",
          }
        })
        .then(function(response){
          console.log(response.data);
          //alert(response.data.jwt);
          localStorage.setItem("auth", response.data.jwt);
          window.location.href='createuser.php';
          
        })
        .catch(function (error) {
          console.log(error);
        });
      }
      else
      {
        alert("Fill All Field");
      }
      
    }
  }

   })

   
    </script>
  </body>
</html>