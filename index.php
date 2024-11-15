<?php 
require "header.php";
require "addData.php";
?>
<style>
<?php include 'styles.scss'; ?>
</style>

<div style="min-height: 100vh; margin-top: 16px;">
    <?php 
    // Vérifiez si des données ont été soumises via POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $prenom = $_POST['prenom'] ?? '';
        $nom = $_POST['nom'] ?? '';
        $telephone = $_POST['telephone'] ?? '';

        // Appel à la fonction pour ajouter un contact
        if (addData($prenom, $nom, $telephone)) {
            // Redirection après ajout pour éviter la resoumission
            header("Location: index.php?status=success");
            exit();
        } else {
            // Redirection en cas d'échec
            header("Location: index.php?status=error");
            exit();
        }
    }

    // Affiche un message basé sur les paramètres de l'URL
    if (isset($_GET['status'])) {
        if ($_GET['status'] === 'success') {
            echo "<p style='color: green;'>Contact ajouté avec succès !</p>";
        } elseif ($_GET['status'] === 'error') {
            echo "<p style='color: red;'>Erreur lors de l'ajout du contact.</p>";
        } elseif ($_GET['status'] === 'delete_success') {
            echo "<p style='color: green;'>Contact supprimé avec succès !</p>";
        } elseif ($_GET['status'] === 'delete_error') {
            echo "<p style='color: red;'>Erreur lors de la suppression du contact.</p>";
        } elseif ($_GET['status'] === 'edit_success') {
            echo "<p style='color: green;'>Contact modifié avec succès !</p>";
        } elseif ($_GET['status'] === 'edit_error') {
            echo "<p style='color: red;'>Erreur lors de la modication du contact.</p>";
        }
    }

    // Inclusion de la liste des contacts
    require "data.php"; 
    ?>
    <h1>Gestion des contacts</h1>
    <form action='index.php' method='post'>
        <label for='prenom'>Prénom: </label>
        <input type='text' name='prenom' required>
        <label for='nom'>Nom: </label>
        <input type='text' name='nom' required>
        <label for='telephone'>Téléphone: </label>
        <input type='text' name='telephone' required>
        <input type='submit' value='Ajouter un contact'>
    </form>
</div>
<?php
require "footer.php";
?>
