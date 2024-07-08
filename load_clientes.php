<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "le_planes";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$clientes = [];

if (isset($_POST['busca'])) {
    $busca = $_POST['busca'];
    $sql = "SELECT id, nome, telefone FROM clientes WHERE nome LIKE '%$busca%'";
} else {
    $sql = "SELECT id, nome, telefone FROM clientes";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($cliente = $result->fetch_assoc()) {
        $clientes[] = $cliente;
    }
}

$conn->close();
?>

<table>
    <tr>
        <th>Nome</th>
        <th>Telefone</th>
    </tr>
    <?php foreach ($clientes as $cliente) { ?>
        <tr>
            <td><a href="cliente.php?id=<?php echo $cliente['id']; ?>"><?php echo $cliente['nome']; ?></a></td>
            <td><?php echo $cliente['telefone']; ?></td>
        </tr>
    <?php } ?>
</table>
