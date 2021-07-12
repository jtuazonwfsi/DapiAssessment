<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=1080px, initial-scale=1.0">
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <title>DAPI</title>
</head>
<body>
  <script src="https://cdn.dapi.co/connect/v3/connector.js"></script>
  <script>
    var accessCode_='';
    var connectionID_='';
    var bankId_='';
    var userSecret_='';
    var handler = Dapi.create({
      environment: Dapi.environments.sandbox,
      appKey: '98ba5f2e7dbee258daa7628431afaf680cb7ed48a95c553ea3d24846854e75fe',
      countries: ['AE'],
      isExperimental: true,
      onSuccess: function(d) {
            console.log(d);
            //alert(d.accessCode);
            localStorage.setItem("accesscode", d.accessCode);
            localStorage.setItem("connectionid", d.connectionID);
            localStorage.setItem("bankid", d.bankId);
            localStorage.setItem("userSecret", d.userSecret);
            accessCode_ = d.accessCode;
            connectionID_ = d.connectionID;
            bankId_ = d.bankId;
            userSecret_ = d.userSecret;
            getAccessToken();
          },
      onFailure: (e) => console.log(e),
    });
    setTimeout(() => {
      handler.open();
    }, 5000)

    function getAccessToken()
    {

      axios.post('https://api.dapi.co/v2/auth/ExchangeToken', {
              appSecret:'2c900824db13dd26525aaed73fa72fee38c2bd042ea7ad2fb18ccc27d344ae06', 
              accessCode:accessCode_,
              connectionID:connectionID_,
              },{
                headers: {
                    'Content-Type': 'application/json'
              }
             
            })
            .then(function(response){
              console.log(response.data);
              localStorage.setItem("tokenID", response.data.tokenID);
              localStorage.setItem("accessToken", response.data.accessToken);
              localStorage.setItem("userID", response.data.userID);
              window.location.href='bankdetails.php';
            })
            .catch(function (error) {
              console.log(error);
            });
    }
  </script>
</body>
</html>