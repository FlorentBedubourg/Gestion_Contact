<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=supdevinci', 'root', '');
    $result = $db->query("SELECT * FROM supdevinci");
?>
    <h1>Liste des contacts</h1>
    <table border='1'>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Téléphone</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
        <?php while ($row = $result->fetch()) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['nom']); ?></td>
                <td><?php echo htmlspecialchars($row['prenom']); ?></td>
                <td><?php echo htmlspecialchars($row['telephone']); ?></td>
                <td>
                    <!-- Bouton de modification -->
                    <form action="edit_contact.php" method="get" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit">Modifier</button>
                    </form>
                </td>
                <td>
                    <!-- Bouton de suppression -->
                    <form action="delete_contact.php" method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" onclick="return confirm('Voulez-vous vraiment supprimer ce contact ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
<?php
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>
