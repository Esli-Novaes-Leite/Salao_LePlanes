<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "le_planes";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
$sql = "SELECT cliente_id FROM procedimentos WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $procedimento = $result->fetch_assoc();
    $cliente_id = $procedimento['cliente_id'];
    $sql = "DELETE FROM procedimentos WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: cliente.php?id=" . $cliente_id);
    } else {
        echo "Erro ao remover procedimento: " . $conn->error;
    }
} else {
    echo "Procedimento não encontrado.";
}

$conn->close();
?>
