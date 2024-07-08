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
$sql = "SELECT * FROM procedimentos WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $procedimento = $result->fetch_assoc();
} else {
    echo "Procedimento não encontrado.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $procedimento = $_POST['procedimento'];
    $valor = $_POST['valor'];
    $horario = $_POST['horario'];

    $sql = "UPDATE procedimentos SET procedimento = '$procedimento', valor = '$valor', horario = '$horario' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: cliente.php?id=" . $procedimento['cliente_id']);
    } else {
        echo "Erro ao atualizar procedimento: " . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Procedimento - Salão Lê Planes</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Salão Lê Planes</h1>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="cadastrar.html">Cadastrar Cliente</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Editar Procedimento</h2>
        <form method="post" action="">
            <label for="procedimento">Procedimento:</label>
            <input type="text" id="procedimento" name="procedimento" value="<?php echo $procedimento['procedimento']; ?>" required>
            <label for="valor">Valor:</label>
            <input type="number" id="valor" name="valor" step="0.01" value="<?php echo $procedimento['valor']; ?>" required>
            <label for="horario">Horário:</label>
            <input type="time" id="horario" name="horario" value="<?php echo $procedimento['horario']; ?>" required>
            <button type="submit">Salvar</button>
        </form>
        <a href="cliente.php?id=<?php echo $procedimento['cliente_id']; ?>">Voltar</a>
    </main>
    <footer>
        <p>&copy; 2024 Salão Lê Planes</p>
    </footer>
</body>
</html>
