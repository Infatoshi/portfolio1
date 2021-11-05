<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>




  <!-- trying to enter any usd or cad amount and convert to btc or eth -->



  <?php

  $url = "https://bitpay.com/api/rates";

  $json = file_get_contents($url);
  $data = json_decode($json, TRUE);


  $BTCrate = $data[0]["rate"];
  $ETHrate = $data[13]["rate"];
  $CADrate = $data[6]["rate"];
  $USDrate = $data[2]["rate"];
  // fix rates based on bitpay

  $constPrice = 1;     # Let cost be 1$
  $BTC_to_CAD_price = number_format($CADrate, 2);
  
  $ETH_to_CAD_price = number_format($CADrate / $ETHrate, 2);
  $BTC_to_USD_price = number_format($USDrate, 2);
  $ETH_to_USD_price = number_format($USDrate / $ETHrate, 2);
  // eth is at [13]
  

// if USD 1.00 then CAD 1.25

  if (isset($_POST['submitConv'])) {

 



    $currOption = $_POST["currencyOptions"];
    $cryptoOption = $_POST['cryptoOptions'];

    if ($currOption == "typeCAD" && $cryptoOption == 'typeBTC') {

      echo 'Price: ' . number_format($constPrice, 2) . ' BTC / $' . $BTC_to_CAD_price;
      
    } elseif ($currOption == "typeCAD" && $cryptoOption == 'typeETH') {

      echo 'Price: ' . number_format($constPrice, 2) . ' ETH / $' . $ETH_to_CAD_price;
      
    } else if ($currOption == "typeUSD" && $cryptoOption == 'typeBTC') {

      echo 'Price: ' . number_format($constPrice, 2) . ' BTC / $' . $BTC_to_USD_price;
      
    } else if ($currOption == "typeUSD" && $cryptoOption == 'typeETH') {

      echo 'Price: ' . number_format($constPrice, 2) . ' ETH / $' . $ETH_to_USD_price;
      
    } else {

      echo 'Error with selection. Please try again.';
    }
  }


  ?>

 
  

  <form method="POST">
    <select class="menus" name="currencyOptions">
      <option class="CADstyle" value="typeCAD">Canadian Dollar</option>
      <option class="USDstyle" value="typeUSD">United States Dollar</option>
    </select>
    <br>
    <br>
    <select class="menus" name="cryptoOptions">
      <option class="BTCstyle" value="typeBTC">Bitcoin</option>
      <option class="ETHstyle" value="typeETH">Ethereum</option>

    </select>
    <p><input class="waves-effect waves-light btn" type="submit" name="submitConv" value="Convert"></p>
  </form>






</body>

</html>