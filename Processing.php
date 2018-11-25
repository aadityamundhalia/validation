<?php
require_once('db.php');
/**
 *
 */
class Processing
{
  private $_servername = "localhost";
  private $_username = "root";
  private $_password = "aaditya";
  private $_dbname = "icon";
  private $_conn;

  function __construct()
  {
    $this->_conn = new PDO("mysql:host=$this->_servername;dbname=$this->_dbname", $this->_username, $this->_password);
    $this->_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  public function createTable($sql)
  {
    try {
        $this->_conn->exec($sql);
        return true;
    } catch (\Exception $e) {
        return false;
    }
  }

  public function addData($name, $email, $phone, $business_name, $suburb, $postcode, $state)
  {
    try {
         $stmt = $this->_conn->prepare("INSERT INTO validation (name, email, phone, business_name, suburb, postcode, state)
         VALUES (:name, :email, :phone, :business_name, :suburb, :postcode, :state)");
             $stmt->bindParam(':name', $name);
             $stmt->bindParam(':email', $email);
             $stmt->bindParam(':phone', $phone);
             $stmt->bindParam(':business_name', $business_name);
             $stmt->bindParam(':suburb', $suburb);
             $stmt->bindParam(':postcode', $postcode);
             $stmt->bindParam(':state', $state);
                 // insert a row
                 /*
                 $name = "Aditya";
                 $email = "aaditya.mundhalia@gmail.com";
                 $phone = "0451033441";
                 $business_name = "test";
                 $suburb = "Ingleburn";
                 $postcode = 2565;
                 $state = "NSW";
                 //$stmt->execute();
                 */
                 if($stmt->execute() == true)
                 {
                   if($this->sendEmail($name, $email, $phone, $business_name, $suburb, $postcode, $state))
                   {
                    return true;
                   }
                   else {
                     return false;
                   }
                 }
                 else {
                   return false;
                 }
       }
       catch(PDOException $e)
       {
         return "Error: " . $e->getMessage();
       }
  }

  private function sendEmail($name, $email, $phone, $business_name, $suburb, $postcode, $state)
  {
    $to = "trevor@iconvisual.com.au";
    //$to = "aaditya.mundhalia@gmail.com";
    $subject = "TEST EMAIL FROM TRIAL";
    $txt = "name: ".$name." | "."email: ".$email." | "."phone: ".$phone." | "."business_name: ".$business_name." | "."suburb: ".$suburb." | "."postcode: ".$postcode." | "."state: ".$state;
    $headers = "From: aaditya.mundhalia@gmail.com" . "\r\n" .
    "CC: michael@iconvisual.com.au";

    if(mail($to,$subject,$txt,$headers))
    {
      return true;
    }
    else {
      return false;
    }
  }
  public function closeConnection()
  {
    $this->_conn = null;
  }
}
$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
if(!isset($_POST['phone']))
{
$phone = "";
}
else
{
$phone = htmlspecialchars($_POST['phone']);
}
if(!isset($_POST['businessName']))
{
$businessName = "";
}
else
{
$businessName = htmlspecialchars($_POST['businessName']);
}
$suburb = htmlspecialchars($_POST['suburb']);
$sqlite = new MyDB();
$result = $sqlite->query('SELECT suburb, postcode, state FROM data where suburb = "'.$suburb.'"');
if($result->fetchArray())
{
$row = $result->fetchArray();
$state = $row['state'];
$postcode = $row['postcode'];
}
else
{
die('Unable to find suburb');
}
$db = new Processing();
$sql = "CREATE TABLE IF NOT EXISTS validation (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                   name VARCHAR(30) NOT NULL,
                                   email VARCHAR(30) NOT NULL,
                                   phone VARCHAR(30),
                                   business_name VARCHAR(30),
                                   suburb VARCHAR(30) NOT NULL,
                                   postcode int(4) NOT NULL,
                                   state VARCHAR(30) NOT NULL
                                )";
$db->createTable($sql);
if($db->addData($name, $email, $phone, $businessName, $suburb, $postcode, $state) == true)
{
  echo "<H1 align='center'>Thank you for your enquiry. A member of our team will be in contact with you as soon as possible.</H1>";
}
else {
  {
    echo "error occured";
  }
}
$db->closeConnection();
?>
