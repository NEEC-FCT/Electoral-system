<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Sistema Votação online</title>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!--===============================================================================================-->
      <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
      <!--===============================================================================================-->
      <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
      <!--===============================================================================================-->
      <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
      <!--===============================================================================================-->
      <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
      <!--===============================================================================================-->
      <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
      <!--===============================================================================================-->
      <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
      <!--===============================================================================================-->
      <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
      <!--===============================================================================================-->
      <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
      <!--===============================================================================================-->
      <link rel="stylesheet" type="text/css" href="css/util.css">
      <link rel="stylesheet" type="text/css" href="css/main.css">
      <!--===============================================================================================-->
      <script>
	  
	  function compare_dates(date1,date2){
	  console.log(date1);
	  	  console.log(date2);
		 if (parseInt(date1) > parseInt(date2)) return true;
	     else if ( parseInt(date1) < parseInt(date2)) return false;
	     else return false; 
	  }
		
        function validateForm() {
             
         if( compare_dates(new Date(2020, 5, 17, 14, 30, 0, 0).getTime(), new Date().getTime() )){
			alert("Não pode votar antes da reunião.");
			return false;
		 }
		 else if ($('input[name=voto]:checked').length == 0) {
             alert("Escolha uma opção de voto");
         	return false;
         }
         else{
			var r = confirm("Deseja enviar o voto?");
			if (r == true) {
			   return true;
			} else {
			  return false;
			}
         }
         	
   }
      </script>
   </head>
   <body>
      <div class="container-contact100">
         <div class="wrap-contact100">
            <form action="vote.php?token=<?php echo $_GET['token']; ?>" onsubmit="return validateForm()" class="contact100-form validate-form" method="post">
               <span class="contact100-form-title">
               Bem-vindo
               </span>
               <div class="wrap-input100 validate-input bg1 rs1-wrap-input100">
                  <span class="label-input100">Eleições para a direcção do NEEC-FCT</span>
                  <div class="contact100-form-radio m-t-15">
                     <input class="input-radio100" id="radio1" type="radio" name="voto" value="ListaA">
                     <label class="label-radio100" for="radio1">
                     Lista A
                     </label>
                  </div>
                  <div class="contact100-form-radio m-t-15">
                     <input class="input-radio100" id="radio1" type="radio" name="voto" value="ListaB" >
                     <label class="label-radio100" for="radio1">
                     Lista B
                     </label>
                  </div>
                  <div class="contact100-form-radio m-t-15">
                     <input class="input-radio100" id="radio1" type="radio" name="voto" value="Nulo" >
                     <label class="label-radio100" for="radio1">
                     Nulo
                     </label>
                  </div>
                  <div class="contact100-form-radio">
                     <input class="input-radio100" id="radio1" type="radio" name="voto" value="Branco">
                     <label class="label-radio100" for="radio1">
                     Branco
                     </label>
                  </div>
               </div>
               <div class="container-contact100-form-btn">
                  <div class="wrap-contact100-form-btn">
                     <div class="contact100-form-bgbtn"></div>
                     <button class="contact100-form-btn">
                     <span>
                     Enviar voto
                     <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
                     </span>
                     </button>
                  </div>
               </div>
            </form>
         </div>
      </div>
      <!--===============================================================================================-->
      <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
      <!--===============================================================================================-->
      <script src="vendor/animsition/js/animsition.min.js"></script>
      <!--===============================================================================================-->
      <script src="vendor/bootstrap/js/popper.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
      <!--===============================================================================================-->
      <script src="vendor/select2/select2.min.js"></script>
      <!--===============================================================================================-->
      <script src="vendor/daterangepicker/moment.min.js"></script>
      <script src="vendor/daterangepicker/daterangepicker.js"></script>
      <!--===============================================================================================-->
      <script src="vendor/countdowntime/countdowntime.js"></script>
      <!--===============================================================================================-->
      <script src="js/main.js"></script>
      <!-- Global site tag (gtag.js) - Google Analytics -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
   </body>
</html>