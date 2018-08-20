<?php
    /*
    need to implement taking into consideration javascript form validation. submit button
    should keep warning errors and say whether or not the email was sent or failed in new
    div in contact section.
     */
    $msg = '';
    $msgClass = '';
    
    // Check if submitted
    if(filter_has_var(INPUT_POST, 'submit')) {
        // get form data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $message = $_POST['message'];

        $nameRegex = '/\S/';
        $emailRegex = '/^(([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5}){1,25})+([;.](([a-zA-Z0-9_\-\.]+)@{[a-zA-Z0-9_\-\.]+0\.([a-zA-Z]{2,5}){1,25})+)*$/';
        $phoneRegex = '/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/';
        $messageRegex = '/\S/';

        // form validation
        if(preg_match($nameRegex, $name) && preg_match($emailRegex, $email) && 
        preg_match($phoneRegex, $phone) && preg_match($messageRegex, $message)) {
            //passed
            $toEmail = 'chrishoward1337@yahoo.com';
            $subject = 'Contact Request From' . $name;
            $body = '<h1>Contact Request</h1>
                    <h4>Name:</h4> <p> ' . $name .'</p>
                    <h4>Email:</h4> <p> ' . $email .'</p>
                    <h4>Phone:</h4> <p> ' . $phone .'</p>
                    <h4>Message:</h4> <p> ' . $message .'</p>';

            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-Type:text/html;charset=UTF-8" . 
                        "\r\n";
            

            $headers .= "From: " . $name . "<" . $email . ">" . "\r\n";

            if(mail($toEmail, $subject, $body, $headers)) {
                $msg = 'Message Sent';
                $msgClass = 'alert-success';
            } else {
                $msg = 'Error: Your Email Was Not Sent';
                $msgClass = 'alert-danger';
            }
        } else {
            //failed
            $msg = 'Please Fill In All Fields';
            $msgClass = 'alert-danger';
        }
    }


?>
<!DOCTYPE html>
<html>
<head>
    <title>Personal Portfolio</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="stylesheet.css">
    <!--Refresher for development. Every 3 seconds-->
    <!-- <meta http-equiv="refresh" content="50"> -->
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <script>
        function editWarningText(regex, input, helpId, helpMessage) {
            if(!regex.test(input)) {
               if(helpId.innerHTML == "") {
                   helpId.innerHTML = helpMessage;
               }
            } else {
                helpId.innerHTML = "";
            }
        }

        function isTheNameFieldEmpty(inputField, helpId) {
            return editWarningText(/\S/, 
            inputField.value, helpId, "*Please enter a valid name");
        }

        function isTheEmailFieldEmpty(inputField, helpId) {
            return editWarningText(/^(([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5}){1,25})+([;.](([a-zA-Z0-9_\-\.]+)@{[a-zA-Z0-9_\-\.]+0\.([a-zA-Z]{2,5}){1,25})+)*$/, 
            inputField.value, helpId, "*Please enter a valid email");
        }

        function isThePhoneFieldEmpty(inputField, helpId) {
            return editWarningText(/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/, 
            inputField.value, helpId, "*Please enter a valid phone number");
        }

        function isTheMessageFieldEmpty(inputField, helpId) {
            return editWarningText(/\S/, inputField.value, helpId, "*Please enter a message");
        }

    </script>
</head>

<body>
    <nav id="navbar">
        <header id="name">Chris Howard</header>
        <ul>
            <li><a href="#welcome-section">About</a></li>
            <li><a href="#projects">Projects</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
    </nav>

    <div id="welcome-section">
        <div id="front-end-images">
            <img id="html-image" class="program-images" src="images/Program symbols/html-image.png">
            <img id="js-image" class="program-images" src="images/Program symbols/js-image3.png">
            <img id="css-image" class="program-images" src="images/Program symbols/css-image.svg">
        </div>
        <div id="welcome-text">
            <h1>Hi, I am Chris</h1>
            <h4>An aspiring web developer</h4>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aliquam dolorem expedita optio, ullam quidem dolorum ut culpa debitis quis quibusdam officia provident accusamus esse unde deleniti. Velit provident eum fugiat, aliquam sint inventore necessitatibus in explicabo natus mollitia similique nisi?</p>
        </div>
        <div id="back-end-images">
            <img id="php-image" class="program-images" src="images/Program symbols/php-image.png">
            <img id="sql-image" class="program-images" src="images/Program symbols/sql-image.png">
        </div>
    </div><div id="projects">
        <h1 id="projects-header">My Projects</h1>
        <div id="project-tile">
            <figure>
                <a href="https://github.com/Crazysaxer/Sample-Product-Landing-Page" target="_blank">
                <img id="img1" src='images/product-landing-page.png' alt='product-landing-page' />
                <figcaption class="project-title">Sample Product Landing Page</figcaption>
                </a>
            </figure>

            <figure>
                <a href="https://github.com/Crazysaxer/Satirical-UMD-Survey" target="_blank">
                <img id="img2" src='images/survey-page.png' alt='survey-page' />
                <figcaption class="project-title">Satirical UMD Survey Page</figcaption>
                </a>
            </figure>
            
            <figure>
                <a href="#" target="_blank">
                <img id="img3" src='images/technical-documentation-page.png' alt='technical-documentation-page' />
                <figcaption class="project-title">Node.js Techincal Documentation Page</figcaption>
                </a>
            </figure>
    
            <figure>
                <a href="https://github.com/Crazysaxer/Satirical-Tribute-Page-" target="_blank">
                <img id="img4" src='images/tribute-page.png' alt='tribute-page' />
                <figcaption class="project-title">Satirical Tribute Page</figcaption>
                </a>
            </figure>

        </div>    
        
    </div>

    <div id="contact">
        <h1 id="contact-title">Contact Me Directly!</h1>
        <?php if(1 == 1): ?>
        <div id="contact-alert" class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>

        <?php endif ?>
        <div id="contact-container">
            <form id="contact-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                
                <label id="name-label" class="contact-label" for="name-area">Name: </label>
                <div class="input-wrapper">
                    <input id="name-area" class="info-box" name="name" type="text" 
                    value="<?php echo isset($_POST['name']) ? $name : ''; ?>" placeholder="Your Name" 
                    onblur="isTheNameFieldEmpty(this, document.getElementById('name-help'))">
                    <span id="name-help" class="help-message"></span>
                </div>
                <label id="email-label" class="contact-label" for="email-area">Email: </label>
                <div class="input-wrapper">
                    <input id="email-area" class="info-box" name="email" type="text" 
                    value="<?php echo isset($_POST['email']) ? $email : ''; ?>" placeholder="Your Email" 
                    onblur="isTheEmailFieldEmpty(this, document.getElementById('email-help'))">
                    <span id="email-help" class="help-message"></span>
                </div>
                <label id="phone-label" class="contact-label" for="phone-area">Phone: </label>
                <div class="input-wrapper">
                    <input id="phone-area" class="info-box" name="phone" type="text" 
                    value="<?php echo isset($_POST['phone']) ? $phone : ''; ?>" placeholder="###-###-####" 
                    onblur="isThePhoneFieldEmpty(this, document.getElementById('phone-help'))">
                    <span id="phone-help" class="help-message"></span>
                </div>
                <label id="message-label" class="contact-label" for="message-area">Message: </label>
                <div class="input-wrapper">
                    <textarea id="message-area" class="info-box" name="message" rows="5" cols="30" placeholder="Your Message" 
                    onblur="isTheMessageFieldEmpty(this, document.getElementById('message-help'))"><?php 
                    echo isset($_POST['message']) ? $message : ''; ?></textarea>
                    <span id="message-help" class="help-message"></span>
                </div>
                <button id="submit-btn" name="submit" type="submit" class="btn">Submit</button>
            </form>
            
            <div id="contact-paragraph">
                    <p>Do you want to get in touch with me? Whether it is to ask for my resume, request more information,
                        talk about my experience as a Computer Science major at UMD, or even ask me what I have sacrificed to Testudo 
                        to have a good GPA... feel free to contact me any time.
                    </p>
                    <p>I promise to reply A.S.A.P.</p>
                    <p id="contact-note">Note: no spam please :)</p>
            </div>
        </div>
    </div>

    <div id="web">
        <h1 id="web-title">Around the web</h1>
        <div id="profile-link-container">
            <p><a href="https://github.com/Crazysaxer" target="_blank">Github</a></p>
            <p><a href="https://www.linkedin.com/in/christopher-howard-15ab54145/" target="_blank">LinkedIn</a></p>
            <p><a href="https://www.facebook.com/chris.howard.39566" target="_blank">Facebook</a></p>
            <p><a href="https://www.freecodecamp.org/crazysaxer" target="_blank">Free Code Camp</a></p>
        </div>
    </div>

    <div id="credit">

    </div>


</body>

</html>