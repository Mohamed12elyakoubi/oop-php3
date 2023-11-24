<?php 
include('db.php');
$conn = new Database();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $conn->addUser($_POST['name'], $_POST['pass']);
        echo '<div class="message" style="text-align: center; font-size:30px; color: green;"  onclick="this.remove();">' . "User is succesvol toegevoegd" . '</div>';
    }
    catch (Exception $e) {
        echo $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>getUser</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body>
    <table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Password</th>
            <th colspan="2">Action</th>
        </tr>
</thead>
    <tbody>
        <tr> 
            <?php
                $data = $conn->getUser();
                foreach ($data as $da) {
                    echo "<td>". $da['ID'] . "</td>";
                    echo "<td>". $da['Name'] . "</td>";
                    echo "<td>". $da['password'] . "</td>";
                    echo "<td><a href='update.php?id={$da['ID']}' class='btn btn-info'>Bewerken</a></td>";
                    echo "<td><a id={$da['ID']}' class='btn btn-danger'>Verwijderen</a></td>";
            ?>
        </tr>
        <?php  } ?>
        </tbody>
    </table>

    <h1>Users</h1>
    <form method="POST">
            <div class="form-group">
                <label for="gebruiker">Gebruikersnaam:</label>
                <input type="text" class="form-control" id="Gebruikersnaam" name="name" required>
            </div>
            <div class="form-group">
                <label for="wachtwoord">wachtwoord:</label>
                <input type="passwoord" class="form-control" id="wachtwoord" name="pass" required>
            </div>
            <button type="submit" class="btn btn-primary">Toevoegen</button>
        </form>
    
</body>
</html>