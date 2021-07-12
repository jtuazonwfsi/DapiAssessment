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
      
      <div class="container" style="height: 500px;width:280px;border: 1px solid #d9d9d9;">
       


        <label for="name"><b>Beneficiary</b></label>
        <input type="text" placeholder="beneficiary" id='bname' readonly>

        <label for="iban"><b>Iban</b></label>
        <input type="text" placeholder="IBAN" id='acciban' readonly>

        <label for="type"><b>Account Number</b></label>
        <input type="text" placeholder="Account Number" id='accnum' readonly>

        <label for="bal"><b>Amount</b></label>
        <input type="text" placeholder="Amount" id='transamt' v-model='transamt'>


         
         <button v-on:click="transferbtn">Transfer Amount</button> 
         <button v-on:click="backbtn">Back</button> 

      </div>
    </div>


<script>

    window.onload=function(){
    var auth = localStorage.getItem("accessToken");
    var userSecret_ = localStorage.getItem("userSecret");
    console.log(auth);
    console.log(userSecret_);

    trans.allRecords();
  

}
     
var trans = new Vue({
  el: '#app',
  data: {
       
        bname:"",
        acciban:"",
        accnum:"",
        transamt:"",
        senderid:"",
        auth:localStorage.getItem("accessToken"),
        userSecret_:localStorage.getItem("userSecret")
  },
   
    methods: {
        allRecords: function(){
         axios.post('https://api.dapi.co/v2/payment/beneficiaries/get', {
              appSecret:'2c900824db13dd26525aaed73fa72fee38c2bd042ea7ad2fb18ccc27d344ae06', 
              userSecret:this.userSecret_,
              },{
                headers: {
                    'Authorization': 'Bearer '+this.auth, 
                    'Content-Type': 'application/json'
              }
             
            })
            .then(function(response){
              
              console.log(response.data);
              document.getElementById("bname").value = response.data.beneficiaries[0].name;
              document.getElementById("acciban").value = response.data.beneficiaries[0].iban;
              document.getElementById("accnum").value = response.data.beneficiaries[0].accountNumber;

              
              
             //alert(this.accid);
            })
            .catch(function (error) {
              console.log(error);
            });

            
      },
      
      backbtn: function(){
          window.location.href='bankdetails.php';
      }
      ,
      transferbtn: function(){
        this.senderid = localStorage.getItem("accid");
            var name_ = document.getElementById("bname").value;
            var iban_ = document.getElementById("acciban").value;
            var acc_ = document.getElementById("accnum").value;
          axios.post('https://api.dapi.co/v2/payment/transfer/autoflow', {
              appSecret:'2c900824db13dd26525aaed73fa72fee38c2bd042ea7ad2fb18ccc27d344ae06', 
              userSecret:this.userSecret_,
              amount:parseInt(this.transamt),
              senderID:this.senderid,
              beneficiary:{
                      name: name_,
                      iban: iban_,
                      accountNumber: acc_
                }
              },{
                headers: {
                    'Authorization': 'Bearer '+this.auth, 
                    'Content-Type': 'application/json'
              }
             
            })
            .then(function(response2){
              
              console.log(response2.data);
              alert("Transfer Done.");
              
              
             //alert(this.accid);
            })
            .catch(function (error) {
              console.log(error);
            });
      }
    }

});

   
    </script>
  </body>
</html>



