<?php 
session_start();
      if(isset($_GET['delete'])){
			unset($_SESSION['sc'][$_GET['delete']]);
        }      
if(isset($_GET['clear'])) {
    unset($_SESSION['sc']);
}
?>

<html>

<head>
    <title>Buy Products</title>
    <style>
        table {
    border-collapse: collapse;
    text-align: left;
}

table, td, th {
    border: 1px solid black;
}
th, td {
    padding: 5px;
}
</style>
</head>

<body>
    <h2><u>Shopping Cart</u></h2>
    <form action="buy.php" method="GET">
        <input type="hidden" name="clear" value="1" />
        <input type="submit" value="Empty Basket" />
        <table>
            <tbody>
                <?php
        if(isset($_GET['buy'])){
        $_SESSION['sc'][$_GET['buy']]=$_SESSION['sr'][$_GET['buy']];
        
    }
             
if(isset($_SESSION['sc'])) {

//$_SESSION['sc'][$_GET['buy']]=$_SESSION['sr'][$_GET['buy']];
foreach($_SESSION['sc'] as $key => $value) {
echo "<tr>";
    echo "<td>".$value['name']."</td>" ;
    echo "<td>".$value['baseP']."$</td>";
    echo "<td><a href='buy.php?delete=".$key."'>Delete</a></td>" ;
    echo "</tr>";
}

}
            
        ?>
            </tbody>
        </table>
        <p name="totalCost">Total Cost:$
            <?php
    if(isset($_GET['buy'])){
        $_SESSION['sc'][$_GET['buy']]=$_SESSION['sr'][$_GET['buy']];
        
    }
            
if(isset($_SESSION['sc'])) {
$price = 0;

foreach($_SESSION['sc'] as $key => $value) {
    
    $price = $price + $value['baseP'];
    
}
                echo $price;
            }
            
            
    ?>
        </p>

    </form>

    <h2><u>Find Products</u></h2>
    <form action="buy.php" method="GET">
        <label>Categories: </label>
        <select name="computer">
            <option value=72>Computers</option>
            <optgroup label="Computers"></optgroup>
            <?php $xmlstr = file_get_contents('http://sandbox.api.ebaycommercenetwork.com/publisher/3.0/rest/CategoryTree?apiKey=78b0db8a-0ee1-4939-a2f9-d3cd95ec0fcc&visitorUserAgent&visitorIPAddress&trackingId=7000610&categoryId=72&showAllDescendants=true');
  $xml = new SimpleXMLElement($xmlstr);
    //echo $xmlstr
           
foreach ($xml->category->categories->category as $cat) {
     echo" <option value='".$cat['id']."'><b>$cat->name</b></option>";
        echo"<optgroup label='$cat->name'></optgroup>";
    foreach($cat->categories->category as $inner){
         echo" <option value='".$inner['id']."'>$inner->name</option>";
    }
     };
     
   ?>
        </select>
        <label>Search for items: <input type="text" name="search" /></label>
        <input type="submit" name="Submit" value="Search" />
    </form>

    <table>
        <tbody>
            <?php

    if(isset($_GET["computer"])){
        $cate = $_GET["computer"];
        $search = $_GET["search"];
        $products = file_get_contents("http://sandbox.api.ebaycommercenetwork.com/publisher/3.0/rest/GeneralSearch?apiKey=78b0db8a-0ee1-4939-a2f9-d3cd95ec0fcc&visitorUserAgent&visitorIPAddress&trackingId=7000610&keyword=".$search."&numItems=20&categoryId=".$cate);
        $sxml=new SimpleXMLElement($products);
        echo "<h4>RESULTS<h4>";
 foreach($sxml->categories->category->items->offer as $pros) {   
echo "<tr>";
echo "<td><a href='buy.php?buy=".$pros['id']."'>".(string)$pros->name."</a></td>" ;       
echo "<td>".(string)$pros->basePrice."$</td>";
    echo "<td>".(string)$pros->description."</td>";
    echo "</tr>";
     $_SESSION['sr'][(string)$pros['id']] = array("name" => (string)$pros->name,"baseP" => (string)$pros->basePrice);
 }
        
    }
            
    ?>
    </tbody>
    </table>
    <?php error_reporting(E_ALL);ini_set('display_errors','On');?>

</body>

</html>