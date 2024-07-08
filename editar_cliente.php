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
$sql = "SELECT * FROM clientes WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $cliente = $result->fetch_assoc();
} else {
    echo "Cliente não encontrado.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $data_marcada = $_POST['data_marcada'];

    $sql = "UPDATE clientes SET nome = '$nome', telefone = '$telefone', data_marcada = '$data_marcada' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: cliente.php?id=" . $id);
    } else {
        echo "Erro ao atualizar cliente: " . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente - Salão Lê Planes</title>
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
        <h2>Editar Cliente</h2>
        <form method="post" action="">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo $cliente['nome']; ?>" required>
            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone" value="<?php echo $cliente['telefone']; ?>" required>
            <label for="data_marcada">Data Marcada:</label>
            <input type="date" id="data_marcada" name="data_marcada" value="<?php echo $cliente['data_marcada']; ?>" required>
            <button type="submit">Salvar</button>
        </form>
        <a href="cliente.php?id=<?php echo $cliente['id']; ?>">Voltar</a>
    </main>
    <footer>
        <p>&copy; 2024 Salão Lê Planes</p>
    </footer>
</body>
</html>
