
<?php
//$servername = "localhost";
//$username = "root";
//$password = "open";

$servername = "rm-bp1ll00kd3a5385br.mysql.rds.aliyuncs.com";
$username = "wuxiaojun";
$password = "Wx331021";

//------------------------MySQLi - 面向对象----------------------------
$servername = "rm-bp1ll00kd3a5385br.mysql.rds.aliyuncs.com";
$username = "wuxiaojun";
$password = "Wx331021";
$dbname = "xqt";

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

$sql = "SELECT id, username, auth_key FROM user";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // 输出每行数据
    while($row = $result->fetch_assoc()) {
        echo "<br> id: ". $row["id"]. " - Name: ". $row["username"]. " " . $row["auth_key"];
    }
} else {
    echo "0 个结果";
}
$conn->close();

//exit(0);

//------------------------PDO - 面向对象----------------------------
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Id</th><th>Firstname</th><th>Lastname</th><th>Email</th><th>Reg date</th></tr>";

class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    function current() {
        return "<td style='width: 150px; border: 1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() {
        echo "<tr>";
    }

    function endChildren() {
        echo "</tr>" . "\n";
    }
}



try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM user");
    $stmt->execute();

    // 设置结果集为关联数组
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
        echo $v;
    }
    $dsn = null;
}
catch(PDOException $e)
{
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";

?>

<?php
phpinfo();

?>
