<?php
// Include database connection parameters and CRUD functions
include 'db_source.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle different actions based on the submitted form
    switch ($_POST['action']) {
        case 'create':
            // Create new cliente
            $nome_cliente = $_POST['nome_cliente'];
            $hash_cliente = $_POST['hash_cliente'];
            $new_id = createCliente($nome_cliente, $hash_cliente);
            echo "Created new cliente with ID: $new_id";
            break;

        case 'update':
            // Update existing cliente
            $id_cliente = $_POST['update_id'];
            $nome_cliente = $_POST['update_nome_cliente'];
            $hash_cliente = $_POST['update_hash_cliente'];
            $update_result = updateCliente($id_cliente, $nome_cliente, $hash_cliente);
            echo "Updated $update_result rows.";
            break;

        case 'delete':
            // Delete existing cliente
            $id_cliente = $_POST['delete_id'];
            $delete_result = deleteCliente($id_cliente);
            echo "Deleted $delete_result rows.";
            break;

        default:
            echo "Invalid action.";
            break;
    }
}
?>
