<?php                 
include "header.php";                 
 
	$item1 = new menuItem( "The WP Burger",
            "Freshly made all-beef patty served up with homefries",
            14);
			
	$item2 = new menuItem("WP Kebobs",
            "Tender cuts of beef and chicken, served with your choice of side",
            17);
	$item3= new menuItem("The WP Burger",
            "Freshly made all-beef patty served up with homefries",
            14
        );
    $item4= new menuItem("WP Kebobs",
            "Tender cuts of beef and chicken, served with your choice of side",
            17
        );
			
			$items = Array($item1,$item2,$item3,$item4);
			
			?>

<div id="content" class="clearfix">
	<aside>
		<h2>
			<?php
            echo date ('l');
        ?>'s Specials</h2>
		<hr>
			<?php

        $i = 0;
        $star = "*";

        while($i<4){   
            $item= $items[$i];

            if($item->getItemName()=="The WP Burger"){
                echo '<img src="images/burger_small.jpg" alt="Burger" title="Monday\'s Special - Burger">';
            }else
            {
                echo '<img src="images/kebobs.jpg" alt="Kebobs" title="WP Kebobs">';
            }
            
            echo "<h3>" . $item->getItemName() . " " . $star . ($i + 1) . "</h3>";
            echo "<p>" . $item->getDescription() . " - $" . $item->getPrice() . "</p>";
            echo "<hr>";

            $i++;
            $star .= "*";
        }

        ?>	
		</aside>
		<div class="main">
			<h1>Welcome</h1>
			<img src="images/dining_room.jpg" alt="Dining Room" title="The WP Eatery Dining Room" class="content_pic">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
				<h2>Book your Christmas Party!</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
			</div>
			<!-- End Main -->
		</div>
		<!-- End Content -->

		<?php
    include "footer.php";
?>