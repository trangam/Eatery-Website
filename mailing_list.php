<?php
require_once('abstractDAO.php');
require_once('asswordHash.php');

if (isset($_GET['editId']) && !isset($_SESSION['AdminID'])) {
    header("Location: userlogin.php");
}

$connection = new abstractDAO();
$errName = "";
$errId = "";
$message = "";
$hash = new PasswordHash(8, true);

if (isset($_POST['btnSubmit'])) {
    $connection = new abstractDAO();

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = $_POST['id'];
    } else {
        $errId = "Please enter Id ";
    }

    if (isset($_POST['name']) && !empty($_POST['name'])) {
        $name = $_POST['name'];
    } else {
        $errName = "Please enter name";
    }

    if (isset($_POST['phoneNumber']) && !empty($_POST['phoneNumber'])) {
        $phone = $_POST['phoneNumber'];

        if (!preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $phone)) {
            $errPhone = "Please re_enter phone";
        }
    } else {
        $errPhone =  "Please enter phone number";
    }

    if (isset($_POST['emailAddress']) && !empty($_POST['emailAddress'])) {
        $email = $_POST['emailAddress'];
        if (preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) { 
		} else {
            $errEmail = "Please re_enter valid email address";
        }
    } else {
        $errEmail = "Please enter email";
    }

    if (isset($_POST['referral']) && !empty($_POST['referral'])) {
        $referrer = $_POST['referral'];
    } else {
        $errRef = "Please enter referral ";
    }

    if (empty($errName) && empty($errPhone) && empty($errEmail) && empty($errRef)) {

        $query = "UPDATE mailinglist 
            SET customerName='$name',phoneNumber='$phone',emailAddress='$email',referrer='$referrer'
            WHERE _id='$id'";

        $connection->execute($query);

        $message = "Data was updated successfully!";
        $name = "";
        $phone = "";
        $email = "";
        $referrer = "";
    }
}
include "header.php";
?>

<div id="content" class="clearfix">
<p> <?php
        if (isset($_SESSION['AdminID'])) {
            echo "Session AdminID = $_SESSION[AdminID]<br>Last Login Date = $_SESSION[Lastlogin]";
        } else {
            header("Location: userlogin.php");
        }
            echo("<br><br><button onclick=\"location.href='logout.php'\">Log out!</button>");
    ?></p>
	<table>
		<tr>
			<th>ID</th>
			<th>Customer name</th>
			<th>Phone number</th>
			<th>Email address</th>
		</tr>

 <?php
        $query = "SELECT * from mailinglist";
        $connection->execute($query);
        $result = $connection->execute($query);
        $row = mysqli_fetch_assoc($result);

        while (!empty($row)) {
            $email = $hash->HashPassword($row['emailAddress']);

            echo "<tr>
                    <td><a href='mailing_list.php?editId=$row[_id]' style='color: white'>$row[_id]</a></td>        
                    <td>$row[customerName]</td>
                    <td>$row[phoneNumber]</td>
                    <td>$email</td>
                    <td>$row[referrer]</td>
                </tr>";

            $row = mysqli_fetch_assoc($result);
        }
        ?>
	</table>
	 <hr>

    <div style="color: pink">
        <?php echo $success; ?>
    </div>

    <?php
    if (isset($_GET['editId'])) {
        $query = "SELECT * FROM mailinglist WHERE _id='$_GET[editId]'";
        $result = $connect->execute($query);

        $row = $result->fetch_assoc();

        if (!is_null($row)) {
            ?>
		<form action="" method = "POST">
			<table>
				<tr>
					<td>ID:</td>
					<td>
						<input type="number" name="id">
						</td>
						<td style="color: red">
							<?php  echo $errId; ?>
						</td>
					</tr>
					<tr>
						<td>Customer name:</td>
						<td>
							<input type="text" name ="name">
							</td>
							<td style="color: red">
								<?php echo $errName;?>
							</td>
						</tr>
						<tr>
							<td>
							     <td colspan='2'><input type='submit' name='btnSubmit' id='btnSubmit' value='Update'>&nbsp;&nbsp; <a href="mailing_list.php">
								 <input type='reset' name="btnReset" id="btnReset" value="Reset">	
							</td>
						</tr>

					</table>
				</form>
			</div>


<?php
include "footer.php";
?>
			