<?php
include "header.php";
require_once('./dao/customerDao.php');
?>
<?php
/*$referrer = "";
$errName = "";
$errPhone = "";
$errEmail = "";
$errRef = "";
$message = "";
$name = "";
$phone = "";
$email = "";
$errFile = "";*/

try{
     $customerDao = new customerDao;
     $haserror = false;
     $errormessage = Array();
    
      if(isset($_POST['customerName'])||
         isset($_POST['phoneNumber'])||
         isset($_POST['emailAddress'])||
         isset($_POST['referral'])){
        
            if($_POST['customerName']==""){
                $haserror = true;
                $errormessage['customerName'] = "Please enter a name";
            }
            
            if (empty($_POST["phoneNumber"])){
                $haserror = true;
                $errormessage['phoneNumber'] = "Please enter a phone number";
            }
            
            if(!preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/i", $_POST ['phoneNumber']) ){
                $haserror = true;
                $errormessage['phoneNumber'] = "Please enter an appropriate phone number";
            }                
           
            if (empty ( $_POST ['emailAddress'] ) || (! filter_var ( $_POST ['emailAddress'], FILTER_VALIDATE_EMAIL ))){
                $haserror = true;
                $errormessage['emailAddress'] = "Please enter an email address";
            }
           
            
          
            if($customerDao->duplicateEmail($_POST['emailAddress'])){
                $haserror = true;
                $errormessage['emailAddress'] = "Duplicate Email Address.";
            }
    
    
            if (empty($_POST["referral"])) {
                $haserror = true;
                $errormessage['referral'] = "Referral is required";
            }
            
       
        if(!$haserror){
            $email = $_POST['emailAddress'];
            $hash = password_hash($email, PASSWORD_DEFAULT);
            $hash2 = password_hash($email, PASSWORD_DEFAULT);
            $customer = new customer(0,$_POST['customerName'],$_POST['phoneNumber'],$hash,$_POST['referral']);
            $addSuccess = $customerDao->addCustomer($customer);
            echo '<h3>'. $addSuccess .'</h3>';
            

		// To File upload to directory named 'file' 
		if(isset($_POST["myfile"])){
			$path = 'files/';
			$upload_file = $path.basename($_FILES['fileUpload']['name']);

			if(move_uploaded_file($_FILES['fileUpload']['tmp_name'],$upload_file)){
				echo "<script>alert('File uploaded successfully!');</script>";  // To show alert message when file uploaded successfully
			} else {
				echo "<script>alert('Failed!');</script>";   // To show alert message when file upload failed.
			}
		}


        }
    }
    
    
?>
<div id="content" class="clearfix">
	<aside>
		<h2>Mailing Address</h2>
		<h3>1385 Woodroffe Ave<br>
                            Ottawa, ON K4C1A4</h3>
			<h2>Phone Number</h2>
			<h3>(613)727-4723</h3>
			<h2>Fax Number</h2>
			<h3>(613)555-1212</h3>
			<h2>Email Address</h2>
			<h3>info@wpeatery.com</h3>
		</aside>
		<div class="main">
			<h1>Sign up for our newsletter</h1>
			<p>Please fill out the following form to be kept up to date with news, specials, and promotions from the WP eatery!</p>
			<form name="frmNewsletter" id="frmNewsletter" method="post" action="">
				<table>
					<tr>
						<td>Name:</td>
						<td>
							<input type="text" name="customerName" id="customerName" size='40'> 
							<?php 
                                if(isset($errormessage['customerName'])){
                                    echo '<span style=\'color:red\'>'.$errormessage['customerName'].'</span>';
                                }
                                ?>
							</td>
							
						</tr>
						<tr>
							<td>Phone Number:</td>
							<td>
								<input type="text" name="phoneNumber" id="phoneNumber" size='40' value="
                               <?php if(isset($_POST['phoneNumber'])){
                                 echo $_POST['phoneNumber'];
                                }
                                ?>">
                                <?php 
                                if(isset($errormessage['phoneNumber'])){
                                    echo '<span style=\'color:red\'>'.$errormessage['phoneNumber'].'</span>';
                                }
                                ?>
								</td>
							</tr>
							<tr>
								<td>Email Address:</td>
								<td>
									<input type="text" name="emailAddress" id="emailAddress" size='40' >
										<?php 
                                if(isset($errormessage['emailAddress'])){
                                    echo '<span style=\'color:red\'>'.$errormessage['emailAddress'].'</span>';
                                }
                                ?>
										</td>
									</tr>
									<tr>
										<td>How did you hear<br> about us?</td>
											<td>Newspaper<input type="radio" name="referral" id="referralNewspaper" value="newspaper"  >
                                    Radio<input type="radio" name='referral' id='referralRadio' value='radio' >
                                    TV<input type='radio' name='referral' id='referralTV' value='TV'>
                                    Other<input type='radio' name='referral' id='referralOther' value='other'>
                                     <?php 
                                if(isset($errormessage['referral'])){
                                 echo '<span style=\'color:red\'>' . $errormessage['referral'] . '</span>';
                            }
                                   ?></td>							
											</tr>
											<tr>
									<td>File Upload:</td>
									<td><input type="file" name="fileUpload" id="fileUpload" value="Upload File">&nbsp;&nbsp;<input type='submit' name="myfile" id="myfile" value="Upload"></td>
								     </tr>
												<tr>
													<td colspan='2'>
													<input type='submit' name='btnSubmit' id='btnSubmit' value='Sign up'>&nbsp;&nbsp;<input type='reset' name="btnReset" id="btnReset" value="Reset">
											</td>
											</tr>
												</table>
												</form>
												</div>
													<!-- End Main -->
													</div>
													<!-- End Content -->
<?php   
  
    }catch(Exception $e){
            echo '<h3>Error on page.</h3>';
            echo '<p>' . $e->getMessage() . '</p>';            
        }
            ?>
	<?php
        include "footer.php";
    ?>
																