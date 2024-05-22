
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Document</title>
</head>
<body>

<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "project";

// تأمين البيانات المدخلة
$fullname = htmlspecialchars($_POST['fullname']);
$phonenumber = htmlspecialchars($_POST['phonenumber']);
$birthday = htmlspecialchars($_POST['birthday']);
$addres = htmlspecialchars($_POST['addres']);

// إنشاء اتصال بقاعدة البيانات
$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully";
}
?>

<form action ="" method="post">
fullname :<input type = "text"  name="fullname"><br>
phonenumber :<input type="text" name="phonenumber"><br>
birthday:<input type="date"  name="birthday"><br>
addres :<input type = "text"  name="addres"><br>
email:<input type="email"   name="email"><br>
<input type = "submit" name="" value="send">
</form>

<?php
// استخدام استعلام محضر لتأمين الإدخال
$insert_query = $conn->prepare("INSERT INTO clients (fullname,email,phonenumber, birthday, addres) VALUES ($fullname, $email, $phonenumber, $birthday,$addres)");
$insert_query->bind_param( $fullname, $email,$phonenumber, $birthday, $addres);

if ($insert_query->execute()) {
    echo "Client inserted successfully";
    $cleintID = $conn->insert_id;

    // الحصول على productID من جدول product
    $result = $conn->query("SELECT productID FROM product");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $productID = $row['productID'];

            // استخدام استعلام محضر لإدراج بيانات الطلبات
            $insert_query2 = $conn->prepare("INSERT INTO Orders (cleintID, productID,order_date) VALUES ($clientID,$productID,now)");
            $insert_query2->bind_param( $cleintID, $productID);

            if ($insert_query2->execute()) {
                echo "Order inserted successfully for productID: $productID";
            } else {
                echo "Failed to insert order for productID: $productID";
            }
        }
    } else {
        echo "No products found";
    }
} else {
    echo "Failed to insert client";
}

$conn->close();
?>
</html>