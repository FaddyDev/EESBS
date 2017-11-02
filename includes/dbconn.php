 <?php
$servername = "localhost";
$username = "root";
$password = "";

//Create db
$sql = "";
try {
    $pdo = new PDO("mysql:host=$servername", $username, $password);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE IF NOT EXISTS eesbs";
    // use exec() because no results are returned
    $pdo->query($sql);
    //echo "Database created successfully<br>";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

//Create tables
$sql2 = "";
try {
    $conn = new PDO("mysql:host=$servername;dbname=eesbs", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     // sql to create table	
	
    $t1 = "CREATE TABLE IF NOT EXISTS s_providers (
    uid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    role INT(5) NOT NULL, /*admin 0, sp's 1*/
    logo VARCHAR(100) NOT NULL,
    companyName VARCHAR(50) NOT NULL,
    c_location VARCHAR(30) NOT NULL,
    email VARCHAR(50) ,
	phone VARCHAR(15) NOT NULL,
	till VARCHAR(15) NOT NULL,
	username VARCHAR(30) NOT NULL,
	password VARCHAR(255) NOT NULL,
    active INT(5) NOT NULL, /*0 or 1*/
    reg_date TIMESTAMP
    )";
	
	$t2 = "CREATE TABLE IF NOT EXISTS tents (
    tid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	uid INT(15) NOT NULL,
    code VARCHAR(15) NOT NULL,
    type VARCHAR(50) NOT NULL,
    image VARCHAR(50) NOT NULL,
	size VARCHAR(50) NOT NULL,
	people INT(15) NOT NULL,
	price INT(15) NOT NULL,
    reg_date TIMESTAMP
    )";
	
	$t3 = "CREATE TABLE IF NOT EXISTS seats (
    sid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	uid INT(15) NOT NULL,
    code VARCHAR(15) NOT NULL,
    type VARCHAR(50) NOT NULL,
    image VARCHAR(50) NOT NULL,
	quantity INT(15) NOT NULL,
	price INT(15) NOT NULL,
    reg_date TIMESTAMP
    )";
	
	$t4 = "CREATE TABLE IF NOT EXISTS catering (
    cid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	uid INT(15) NOT NULL,
    code VARCHAR(15) NOT NULL,
    type VARCHAR(50) NOT NULL,
    image VARCHAR(50) NOT NULL,
	menu VARCHAR(100) NOT NULL,
	price INT(15) NOT NULL,
    reg_date TIMESTAMP
    )";
	
	$t5 = "CREATE TABLE IF NOT EXISTS venues (
    vid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	uid INT(15) NOT NULL,
    code VARCHAR(15) NOT NULL,
	image VARCHAR(50) NOT NULL,
	people int(15) NOT NULL,
	price INT(15) NOT NULL,
    reg_date TIMESTAMP
    )";
	
	$t6 = "CREATE TABLE IF NOT EXISTS equipment (
    eid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	uid INT(15) NOT NULL,
    code VARCHAR(15) NOT NULL,
    type VARCHAR(50) NOT NULL,
    image VARCHAR(50) NOT NULL,
	price INT(15) NOT NULL,
    reg_date TIMESTAMP
    )";

    $t7 = "CREATE TABLE IF NOT EXISTS orders (
    orid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	uid INT(15) NOT NULL, /*The owner of the items*/
    itmid INT(15) NOT NULL, /*Id of the item*/
    bid INT(15) NOT NULL, /*The id of the buyer, important for knowing total number of items orderd*/
    svstype VARCHAR(50) NOT NULL,
    size VARCHAR(50) NOT NULL,
    people INT(15) NOT NULL,
    quantity INT(15) NOT NULL,
    transact_id VARCHAR(50) NOT NULL,
	oprice INT(15) NOT NULL, /*The price may change, it's good to record the one duuring time of purchase*/
    address VARCHAR(50) NOT NULL,
    phone VARCHAR(50) NOT NULL, /*or email...of the buyer*/
    reqdate VARCHAR(50) NOT NULL, /*when service is required*/
    date_time VARCHAR(50) NOT NULL, /*when order was placed*/
    reg_date TIMESTAMP /*To add date required*/
    )";

//Money made by each service provider for each order before and after commission
    $t8 = "CREATE TABLE IF NOT EXISTS finances ( 
    fnid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    uid INT(15) NOT NULL, /*The service provider*/
    bid INT(15) NOT NULL, /*Buyer id gives all the items made by a buyer in one order; items belonging to the specific provider*/
	tot_before INT(15) NOT NULL,
    tot_after INT(15) NOT NULL,
    reg_date TIMESTAMP
    )";

    //Messages
    $t9 = "CREATE TABLE IF NOT EXISTS messages ( 
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        uid INT(15) NOT NULL, /*The service provider or admin*/
        message VARCHAR(255) NOT NULL,         
        response VARCHAR(255) NOT NULL, 
        phone INT(15) NOT NULL,
        replied INT(15) NOT NULL, /*0 or 1*/
        reg_date TIMESTAMP
        )";
    //Quiz, how do they withdraw their cash? How is that recorded in the system? The assumption: The EESBS co. pays them immediately.
    // use exec() because no results are returned
    $conn->query($t1);
	$conn->query($t2);
	$conn->query($t3);
	$conn->query($t4);
	$conn->query($t5);
	$conn->query($t6);
	$conn->query($t7);
    $conn->query($t8);
    $conn->query($t9);
    //echo "Tables created successfully<br>";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
	
	
$conn->query("use eesbs");
?> 