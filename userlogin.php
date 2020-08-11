<?php
include "abstractDAO.php";
include "PasswordHash.php";

$connection = new abstractDAO();

$hash = new PasswordHash(8, false);

$error = "";

// $userName = "admin";
// $password = $hash->HashPassword("passme");

// $query = "INSERT INTO adminusers (Username, Password) VALUES ('$userName', '$password')";
// $connection->execute($query);

if (isset($_POST['btnSubmit'])) {
    $userName = $_POST['login'];
    $password = $_POST['password'];
    if ($userName != "" && $password != "") {

        $query = "SELECT * FROM adminusers WHERE Username='$userName'";
        $result = $connection->execute($query);
        // $result->fetch_assoc();
        $row = $result->fetch_assoc();
        if (is_null($row)) {
            $error = "Invalid username and password";
        } else {
            if ($hash->CheckPassword($password, $row['Password'])) {
                $query = "UPDATE adminusers SET Lastlogin=CURRENT_DATE() WHERE AdminID=''";
                $connection->execute($query);

                $_SESSION['AdminID'] = $row['AdminID'];
                $_SESSION['Lastlogin'] = date("d/m/Y");

                header("Location: mailing_list.php");
            } else {
                $error = "Invalid username and password";
            }
        }
    }
}

include "header.php";

?>

<form action="" method="post">
    <div style="color: red">
        <?php echo $error; ?>
    </div>
    <table>
        <tr>
            <td>Login:</td>
            <td><input type="text" name="login"></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><input type="password" name="password"></td>
        </tr>
        <tr>
            <td><input type="submit" name="btnSubmit" value="Log in"></td>
        </tr>
    </table>
</form>