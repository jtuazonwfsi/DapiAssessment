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
       


        <label for="name"><b>Bank Name</b></label>
        <input type="text" placeholder="Bank Name" id='bname' v-model='bname'  readonly>

        <label for="num"><b>Account Number</b></label>
        <input type="text" placeholder="Account Number Name" id='accnum' v-model='accnum'  readonly>

        <label for="iban"><b>Iban</b></label>
        <input type="text" placeholder="IBAN" id='acciban' v-model='acciban'  readonly>

        <label for="type"><b>Type</b></label>
        <input type="text" placeholder="Account Type" id='acctype' v-model='acctype'  readonly>

        <label for="bal"><b>Balance</b></label>
        <input type="text" placeholder="Account Balance" id='accbal' v-model='accbal'  readonly>


         <button v-on:click="transactionbtn">View Transaction History</button> 
         <button v-on:click="transferbtn">Transfer Amount</button> 

      </div>
    </div>


<script>

    window.onload=function(){
    var auth = localStorage.getItem("accessToken");
    var userSecret_ = localStorage.getItem("userSecret");
    console.log(auth);
    console.log(userSecret_);

    bankdetails.allRecords();
    bankdetails.getbalance();

}
     
var bankdetails = new Vue({
  el: '#app',
  data: {
        banks: "",
        bname:"",
        accnum:"",
        acctype:"",
        accbal:"",
        accid:"",
        acciban:"",
        auth:localStorage.getItem("accessToken"),
        userSecret_:localStorage.getItem("userSecret")
  },
   
    methods: {
        allRecords: function(){
         axios.post('https://api.dapi.co/v2/data/accounts/get', {
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
              document.getElementById("bname").value = response.data.accounts[0].currency.name;
              document.getElementById("accnum").value = response.data.accounts[0].number;
              document.getElementById("acciban").value = response.data.accounts[0].iban;
              document.getElementById("acctype").value = response.data.accounts[0].type;
              localStorage.setItem("accid", response.data.accounts[0].id);
             //alert(this.accid);
            })
            .catch(function (error) {
              console.log(error);
            })
            .finally(() => {
                    
                    //console.log("i should go second");
                    
                });;

            
      },
      getbalance: function() { 
        //alert(localStorage.getItem("accid"));
        this.accid = localStorage.getItem("accid");
        console.log(this.accid);
         axios.post('https://api.dapi.co/v2/data/balance/get', {
              appSecret:'2c900824db13dd26525aaed73fa72fee38c2bd042ea7ad2fb18ccc27d344ae06', 
              userSecret:this.userSecret_,
              accountID:this.accid,
              },{
                headers: {
                    'Authorization': 'Bearer '+this.auth, 
                    'Content-Type': 'application/json'
              }
             
            })
            .then(function(response){
              console.log(response.data);
              document.getElementById("accbal").value = response.data.balance.amount;
              
            })
            .catch(function (error) {
              console.log(error);
            });

      },
      transactionbtn: function(){
          window.location.href='transaction.php';
      }
      ,
      transferbtn: function(){
          window.location.href='transfer.php';
      }
    }

});

   
    </script>
  </body>
</html>



