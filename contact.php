<?php
include('db_connect.php');

// Get the form data

if(isset($_POST["submit"])){
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$subject = $_POST['subject'];
}

// Prepare the SQL statement with placeholders
$stmt = $connect->prepare("INSERT INTO ContactForm(name, email, subject, message) VALUES (?, ?, ?, ?)");

// Bind the parameters to the placeholders
$stmt->bind_param("ssss", $name, $email, $subject, $message);

// Execute the prepared statement
if ($stmt->execute()) {
    // Success
    
} else {
    // Error
    
}

// Close the statement and database connection
$stmt->close();
$connect->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    

  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  
   <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>  -->
  
  <!-- FONT AWESOME FONTS -->
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.13.0/css/all.css">  
  <style>
.contact .info {
  width: 100%;
  margin-left: -230%;
  margin-top: 50%;
  /*background: #fff;*/
}

.contact .info i {
  font-size: 20px;
  color: #35a093;
  float: left;
  width: 44px;
  height: 44px;
  background: #eef7ff;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 50px;
  transition: all 0.3s ease-in-out;
}

.contact .info h4 {
  padding: 0 0 0 60px;
  font-size: 22px;
  font-weight: 600;
  margin-bottom: 5px;
  color: ##35a093;
}

.contact .info p {
  padding: 0 0 0 60px;
  margin-bottom: 0;
  font-size: 14px;
  color: black;
}

.contact .info .email, .contact .info .phone {
  margin-top: 40px;
}

.contact .info .email:hover i, .contact .info .address:hover i, .contact .info .phone:hover i {
  background: #35a093;
  color: #fff;
}

.contact .php-email-form {
  width: 100%;
  margin-top: -60%;
  /*background: #fff;*/
}

.contact .php-email-form .form-group {
  padding-bottom: 8px;
}

.contact .php-email-form .validate {
  display: none;
  color: red;
  margin: 0 0 15px 0;
  font-weight: 400;
  font-size: 13px;
}

.contact .php-email-form .error-message {
  display: none;
  color: #fff;
  background: #ed3c0d;
  text-align: left;
  padding: 15px;
  font-weight: 600;
}

.contact .php-email-form .error-message br + br {
  margin-top: 25px;
}

.contact .php-email-form .sent-message {
  display: none;
  color: #fff;
  background: #18d26e;
  text-align: center;
  padding: 15px;
  font-weight: 600;
}

.contact .php-email-form .loading {
  display: none;
  background: #fff;
  text-align: center;
  padding: 15px;
}

.contact .php-email-form .loading:before {
  content: "";
  display: inline-block;
  border-radius: 50%;
  width: 24px;
  height: 24px;
  margin: 0 10px -6px 0;
  border: 3px solid #18d26e;
  border-top-color: #eee;
  -webkit-animation: animate-loading 1s linear infinite;
  animation: animate-loading 1s linear infinite;
}

.contact .php-email-form input, .contact .php-email-form textarea {
  border-radius: 4px;
  box-shadow: none;
  font-size: 14px;
  margin-right: 80%;
  width: 80%;
  
}

.contact .php-email-form input {
  height: 44px;
  padding: 5px 12px;

  
}

.contact .php-email-form textarea {
  padding: 10px 12px;
  
}

.contact .php-email-form button[type="submit"] {
  background: #35a093;
  border: 0;
  padding: 10px 35px;
  color: #fff;
  transition: 0.4s;
  border-radius: 50px;
}

.contact .php-email-form button[type="submit"]:hover {
  background: #188678;
}

@-webkit-keyframes animate-loading {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

@keyframes animate-loading {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

.section-title {
  text-align: center;
  padding-bottom: 30px;
  margin-left: 45%;
  margin-top: 5%;
}

.section-title h2 {
  font-size: 32px;
  font-weight: bold;
  text-transform: uppercase;
  margin-bottom: 20px;
  padding-bottom: 20px;
  position: relative;
  color: ##35a093;
}

.section-title h2::before {
  content: '';
  position: absolute;
  display: block;
  width: 120px;
  height: 1px;
  background: #ddd;
  bottom: 1px;
  left: calc(50% - 60px);
}

.section-title h2::after {
  content: '';
  position: absolute;
  display: block;
  width: 40px;
  height: 3px;
  background: #35a093;
  bottom: 0;
  left: calc(50% - 20px);
}

.section-title p {
  margin-bottom: 0;
}


</style>
</head>
 <body>
 	
 <section id="contact" class="contact">
   <div class="container" data-aos="fade-up">
     <div class="section-title">
       <h2>Contact</h2>
         </div>
           <div class="row mt-1">
             <div class="col-lg-4">
               <div class="info">
                 <div class="address">
                   <i class="fas fa-map"></i>
                     <h4>Location:</h4>
                    <p>No: 7, Dubai kurukku sandhu  , Dubai Main Road , Dubai </p>
                   </div>
                 <div class="email">
              <i class="fas fa-envelope"></i>
           <h4>Email:</h4>
        <p>contact@swimming_webiste.com</p>
      </div>

  <div class="phone">
      <i class="fas fa-phone"></i>
         <h4>Call:</h4>
             <p>+91 9999999999</p>
                </div>
                  </div>
                     </div>
                       <div class="col-lg-8 mt-5 mt-lg-0">
                         <form  method="post" role="form" autocomplete="off" class="php-email-form">
                           <div class="form-row">
                             <div class="col-md-6 form-group">
                            <input type="text" name="name" class="form-control formtext" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg ="Please enter at least 4 chars" />
                           <div class="validate"></div>
                       </div>
                     <div class="col-md-6 form-group">
                 <input type="email" class="form-control formtext" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
             <div class="validate"></div>
         </div>
     </div>
     <div class="form-group">
       <input type="text" class="form-control formtext" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
           <div class="validate"></div>
             </div>
               <div class="form-group">
                 <textarea class="form-control formtext" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                    <div class="validate"></div>
                      </div>
                        <div class="mb-3">
                          <div class="loading">Loading</div>
                        <div class="error-message"></div>
                     <div class="sent-message">Your message has been sent. Thank you!</div>
                 </div>
               <div class="text-center"><button type="submit" name="submit">Send Message</button></div>
             </form>
           </div>
        </div>
      </div>
</section><!-- End Contact Section -->


 
</div>
</body>
</html>