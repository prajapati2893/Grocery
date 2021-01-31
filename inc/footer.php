  <footer class="ftco-footer ftco-section">
      <div class="container">
      	<div class="row">
      		<div class="mouse">
						<a href="#" class="mouse-icon">
							<div class="mouse-wheel"><span class="ion-ios-arrow-up"></span></div>
						</a>
					</div>
      	</div>
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Grocery</h2>
              <p>grocery is the finest Platform of buying Fresh Vegetables, Fruits and Grocery at your doors on reasonable price through online mode.</p>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                <li class="ftco-animate"><a target="_blank" href="https://twitter.com/gloriousfrogTek"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a target="_blank" href="https://www.facebook.com/gloriousfrog"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a target="_blank" href="https://www.instagram.com/rahul__anand_"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-5">
              <h2 class="ftco-heading-2">Menu</h2>
              <ul class="list-unstyled">
                <li><a href="index.php" class="py-2 d-block">Home</a></li>
                <li><a href="about.php" class="py-2 d-block">About</a></li>
                <li><a href="faq.php" class="py-2 d-block">Faq</a></li>
                <li><a href="contact.php" class="py-2 d-block">Contact Us</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-4">
             <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Help</h2>
              <div class="d-flex">
	              <ul class="list-unstyled mr-l-5 pr-l-3 mr-4">
	                <li><a href="shipping-information.php" class="py-2 d-block">Shipping Information</a></li>
	                <li><a href="returns.php" class="py-2 d-block">Returns &amp; Exchange</a></li>
	                <li><a href="termsn.php" class="py-2 d-block">Terms &amp; Conditions</a></li>
	                <li><a href="privacy-policy.php" class="py-2 d-block">Privacy Policy</a></li>
	              </ul>
	              
	            </div>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Have a Questions?</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text">Tezpur univesity North Eastern state of Assam, India</span></li>
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+91 7480003003</span></a></li>
	                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">rahulprog@gmail.com</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">

            <p>
						  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Project <a href="http://www.tezu.ernet.in/" target="_blank">Tezpur University</a>
						</p>
          </div>
        </div>
      </div>
    </footer>
     <script>
     function adcrt(id,qty=1)
      {
        var crtbval= document.getElementById('crt').innerHTML;
      
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
           var retrntxt = this.responseText;
            if(isNaN(retrntxt)==true)
            {
               document.getElementById('erorshow').style.display='';
               document.getElementById('erorshow').innerHTML=retrntxt;
               setTimeout(function(){ document.getElementById('erorshow').style.display='none';
               document.getElementById('erorshow').innerHTML=''; }, 2000);
             
            }
            else
            {
              document.getElementById('crt').innerHTML = Number(crtbval)+1;
              document.getElementById('erorshow').style.display='';
              document.getElementById('erorshow').innerHTML='<span style="background: #108602;padding: 2px 10px;">Item Added Successfully</span>';
              setTimeout(function(){ document.getElementById('erorshow').style.display='none';
              document.getElementById('erorshow').innerHTML=''; }, 2000);
            }
          }
        };
        xmlhttp.open("GET", "adcrt.php?cid=" + id+'&qnty='+qty, true);
        xmlhttp.send();
              
      }

function updatecart(kid,txtid,typ)
    {
      var txtids = txtid;
      var type = typ;
      if(type=='del')
      {
        var tp = '&del=del';
      }
      else
      {
        var tp = '&updt=updt';
      }

      var t1 = document.getElementById('quantity'+txtids).value;
       var prce = document.getElementById('prodpr'+txtids).innerHTML;
     
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
           var totdta = Number(prce)*Number(t1);
           document.getElementById('sumtot'+txtids).innerHTML = totdta; 
        }
      };
      xmlhttp.open("GET", "updcrt.php?kid=" + kid+'&qty='+t1+tp, true);
      xmlhttp.send();
      if(type=='del')
      {
        setTimeout(function(){  window.location='cart.php?deleted=deleted'; }, 1000);
      }
      else
      {
        setTimeout(function(){ window.location='cart.php?updated=updated'; }, 1000);
      }
    }
    </script>