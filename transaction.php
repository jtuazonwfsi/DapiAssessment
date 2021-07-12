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
  /*background-color: #edece4; */
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
      
      <div class="container" style="height: 380px;width:750px;border: 0px solid #d9d9d9;">
       


        <div class="tblcontainer" id='tblcontainer' style="">
         <table border='1' width='100%' style='border-collapse: collapse;'>
            <tr>

              <td>Details</td>
              <td>Type</td>
              <td>Amount</td>
              <td>balance</td>
              <td>Transaction Date</td>

            </tr>
            <tbody id="chatresult">
               <tr v-for='(tran, index) in trans' >
                  <td style='width:150px;'>{{ trans[index].details }}</td>
                  <td style='width:150px;'>{{ trans[index].type }}</td>
                  <td style='width:150px;'>{{ trans[index].amount }}</td>
                  <td style='width:150px;'>{{ trans[index].afterAmount }}</td>
                  <td style='width:150px;'>{{ trans[index].date }}</td>
                 

              </tr>
              
            </tbody>
        </table>

        <button v-on:click="backbtn">back</button> 
      </div>
      </div>




      </div>
    </div>


<script>

    window.onload=function(){
    var auth = localStorage.getItem("accessToken");
    var userSecret_ = localStorage.getItem("userSecret");
    var accid_ = localStorage.getItem("accid");
    console.log(auth);
    console.log(userSecret_);
    console.log(accid_ );

    bankdetails.allRecords();
   

}
     
var bankdetails = new Vue({
  el: '#app',
  data: {
        trans: "",
       x:1,
        auth:localStorage.getItem("accessToken"),
        userSecret_:localStorage.getItem("userSecret"),
        accid:localStorage.getItem("accid")
  },
   
    methods: {
        allRecords: function(){
         axios.post('https://api.dapi.co/v2/data/transactions/get', {
              appSecret:'2c900824db13dd26525aaed73fa72fee38c2bd042ea7ad2fb18ccc27d344ae06', 
              userSecret:this.userSecret_,
              fromDate: "2021-07-01",
              toDate: "2021-07-09",
              accountID:this.accid,
              },{
                headers: {
                    'Authorization': 'Bearer '+this.auth, 
                    'Content-Type': 'application/json'
              }
             
            })
            .then(function(response){
              
              console.log(response.data);
               bankdetails.trans = response.data.transactions;
               
              
            })
            .catch(function (error) {
              console.log(error);
            })
            .finally(() => {
                    
                    //console.log("i should go second");
                    
                });;

            
      },
      backbtn: function(){
          window.location.href='bankdetails.php';
      }
    }

});

   
    </script>
  </body>
</html>



