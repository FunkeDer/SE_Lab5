<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Студенти</title>
    <link rel="stylesheet" href="styles.css">
    <title>Студенти</title>
</head>
<body>
<div class=" container">
<?php


echo "<strong>IP-адреса сервера:</strong>" . "<br>" . $_SERVER['SERVER_ADDR'] . "<br>";
echo "<strong>IP-адреса клієнта: </strong>" . "<br>" . $_SERVER['REMOTE_ADDR'] . "<br>";
echo "<strong>Порт сервера: </strong>" . "<br>" . $_SERVER['SERVER_PORT'] . "<br>";
echo "<strong>Користувач агента: </strong>" . "<br>" . $_SERVER['HTTP_USER_AGENT'] . "<br>";


$servername = "192.168.42.138";
$username = "VLAD";
$password = "12341234";
$dbname = "University";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Помилка з'єднання: " . $conn->connect_error);
}


$sql = "SELECT last_name, first_name, age, specialty, gender FROM Students";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    
    echo "<strong>База даних \"University\"</strong>"."<br>" ;
    while($row = $result->fetch_assoc()) {
        
        echo "Name: " . $row["first_name"]. ", Surname: " . $row["last_name"]. ", Age" .$row["age"]. ", Specilty: ". $row["specialty"]. ", Gender: " .$row["gender"]. "<br>";
    }
} else {
    echo "Немає результатів";
}

$query_network = "SELECT * FROM Students WHERE specialty = 'Network Administrator' ORDER BY age";
$query_system = "SELECT * FROM Students WHERE specialty = 'System Administrator' ORDER BY age";
$query_males = "SELECT * FROM Students WHERE gender = 'Male' ORDER BY age";
$query_females = "SELECT * FROM Students WHERE gender = 'Female' ORDER BY age";

if (isset($_POST['button_1'])) {
    $result = $conn->query($query_network);
} elseif (isset($_POST['button_2'])) 
    $result = $conn->query($query_system);
elseif (isset($_POST['button_3'])) {
    $result = $conn->query($query_males);
} elseif (isset($_POST['button_4'])) {
    $result = $conn->query($query_females);
}
?>




<form method="post" action="">
    <div class="button-container">
        <h3>Отримати спеціалістів за наступними критеріями:</h3>
        <input type="submit" name="button_1" value="Мережеві адміністратори">
        <input type="submit" name="button_2" value="Системні адміністратори">
        <input type="submit" name="button_3" value="Хлопці">
        <input type="submit" name="button_4" value="Дівчата">
    </div>
</form>


<div class="result-container">
    <?php
    if (isset($result) && $result->num_rows > 0) {
        echo '<ul>';
        while ($row = $result->fetch_assoc()) {
            // Вивід даних про студента
            echo "<li>ID: " . $row["id"] . " - Last Name: " . $row["last_name"] . " - First Name: " . $row["first_name"] . " - Age: " . $row["age"] . " - Specialty: " . $row["specialty"] . " - Gender: " . $row["gender"] . "</li>";
        }
        echo '</ul>';
    } else {
        echo "<p>Немає результатів</p>";
    }

    $conn->close();
    ?>
</div>
</div>
</body>
</html>