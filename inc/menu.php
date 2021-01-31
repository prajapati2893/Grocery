
<p>	<form method="post" action="shop.php" class="serachers">
        <div class="row"  >
          <div class="col-md-12 text-right">
            
<input type="text" name="search" placeholder="Search.."  required="required" /><input type="submit" name="go" value="Search"  />
            </p>
          </div>
        </div>
         </form>
<?php $pagnam= basename($_SERVER['PHP_SELF']);?>

<span style="z-index: 1111;position: fixed;right: 5%;top: 5%;color: #fff; display: none;" id="erorshow"></span>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.php"><img src="logo.png" class="loger"/></a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item <?php if($pagnam=='index.php'){?>active<?php }?>"><a href="index.php" class="nav-link">Home</a></li>
	         <li class="nav-item <?php if($pagnam=='about.php'){?>active<?php }?>"><a href="shop.php" class="nav-link">Shop</a></li>
	          <li class="nav-item <?php if($pagnam=='about.php'){?>active<?php }?>"><a href="about.php" class="nav-link">About</a></li>
	          <li class="nav-item <?php if($pagnam=='blog.php'){?>active<?php }?>"><a href="blog.php" class="nav-link">Blog</a></li>
	          <li class="nav-item <?php if($pagnam=='contact.php'){?>active<?php }?>"><a href="contact.php" class="nav-link">Contact</a></li>
	          <li class="nav-item cta cta-colored <?php if($pagnam=='cart.php'){?>active<?php }?>"><a href="cart.php" class="nav-link">
	          	<span class="icon-shopping_cart">[<span id="crt"><?php if(!empty($_SESSION["shopping_cart"])){ echo $_SESSION["shopping_cart"]; }else{ ?>0 <?php  }?></span>]</span></a></li>


	          	<?php if(@$_SESSION['userid']!=''){?>
	          		
	          		 <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hi <?php echo  $_SESSION['username'];?></a>
              <div class="dropdown-menu" aria-labelledby="dropdown04">
              	<a class="dropdown-item" href="my_order.php">Order History</a>
                <a class="dropdown-item" href="cart.php">My Cart</a>
                <a class="dropdown-item" href="logout.php">Logout</a>
              </div>
            </li>
	          	<?php } else { ?> 
	          	<li class="nav-item <?php if($pagnam=='login.php'){?>active<?php }?>"><a href="login.php" class="nav-link">Login</a></li>
	          	<li class="nav-item <?php if($pagnam=='registerd.php'){?>active<?php }?>"><a href="registerd.php" class="nav-link">Signup</a></li>
	       		<?php } ?>
	        </ul>

	      </div>
	    </div>
	  </nav>
	  <style>
	      img.loger {
    width: 136px;
    margin: -30px 0 0 0;
}form.serachers {
    margin: 0 11% -10px 0;
    float:;
}

form.serachers input {
    border: 1px solid #999;
    font-size: 13px;
    padding: 2px 7px;
}

form.serachers input[type="submit"] {
    background: #8cc842;
    color: #fff;
    font-weight: bold;
}section.ftco-section.img.offerse .col-md-6 {
    background: #ffffffde;
}

section.ftco-section.img.offerse .col-md-6 p {
    color: #000;
}
	  </style>

