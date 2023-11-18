<?php
include("./storage.php");

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $subject = filter_input(INPUT_POST, "subject", FILTER_SANITIZE_SPECIAL_CHARS);
    $message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($name)) {
        echo "Name is empty";
    } elseif (empty($email)) {
        echo "Email is empty";
    } elseif (!validateEmail($email)) {
        echo "Email is not in the correct format";
    } elseif (empty($subject)) {
        echo "Subject is empty";
    } elseif (empty($message)) {
        echo "Message is empty";
    } else {
        $sql = "INSERT INTO users(name, email, subject, message) VALUES('$name','$email','$subject', '$message')";
        mysqli_query($conn, $sql);
        echo "Your information is registered";
    }
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="style.css">
    <script>
        function validateEmail(email) {
            return /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/.test(email);
        }

        function validateForm() {
            var emailInput = document.querySelector('input[name="email"]');
            if (!validateEmail(emailInput.value)) {
                alert("Email should follow the standard format (e.g., name@abc.com).");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>

    <div class="contact-area section-padding-0-80">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <h3>Contact Us</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="contact-form-area">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post" onsubmit="return validateForm()">
                        
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <input type="text" class="form-control" name="name" placeholder="Name">
                                </div>
                                <div class="col-12 col-lg-6">
                                    <input type="email" class="form-control" name="email" placeholder="Email">
                                </div>
                                <div class="col-12">
                                    <input type="text" class="form-control" name="subject" placeholder="Subject">
                                </div>
                                <div class="col-12">
                                    <textarea name="message" class="form-control" cols="30" rows="10" placeholder="Message"></textarea>
                                </div>
                                <div class="col-12 text-center">
                                    <button class="btn delicious-btn mt-30" type="submit">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
