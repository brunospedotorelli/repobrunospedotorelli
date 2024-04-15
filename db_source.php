<?php
// Database connection parameters
$host = 'db-lab-rhaas-eastus.postgres.database.azure.com';
$dbname = 'postgre';
$username = 'db_user';
$password = 'S3nh@!#2024';

// Connect to the database
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Function to create a new cliente
function createCliente($nome_cliente, $hash_cliente) {
    global $conn;
    $sql = "INSERT INTO cliente (nome_cliente, hash_cliente, data_cadastro) VALUES (:nome, :hash, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome', $nome_cliente);
    $stmt->bindParam(':hash', $hash_cliente);
    $stmt->execute();
    return $conn->lastInsertId();
}

// Function to read all clientes
function readClientes() {
    global $conn;
    $sql = "SELECT * FROM cliente";
    $stmt = $conn->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to update a cliente
function updateCliente($id_cliente, $nome_cliente, $hash_cliente) {
    global $conn;
    $sql = "UPDATE cliente SET nome_cliente = :nome, hash_cliente = :hash WHERE id_cliente = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id_cliente);
    $stmt->bindParam(':nome', $nome_cliente);
    $stmt->bindParam(':hash', $hash_cliente);
    $stmt->execute();
    return $stmt->rowCount();
}

// Function to delete a cliente
function deleteCliente($id_cliente) {
    global $conn;
    $sql = "DELETE FROM cliente WHERE id_cliente = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id_cliente);
    $stmt->execute();
    return $stmt->rowCount();
}

// Usage example:
// Create a new cliente
$new_id = createCliente("John Doe", "abc123");

// Read all clientes
$clientes = readClientes();
foreach ($clientes as $cliente) {
    echo "ID: " . $cliente['id_cliente'] . ", Nome: " . $cliente['nome_cliente'] . "<br>";
}

// Update a cliente
$update_result = updateCliente($new_id, "Jane Doe", "xyz789");
echo "Updated " . $update_result . " rows.";

// Delete a cliente
$delete_result = deleteCliente($new_id);
echo "Deleted " . $delete_result . " rows.";
?>