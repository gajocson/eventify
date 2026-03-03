<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/Registration CSS/Reg_contain_div.css') }}">
     <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
      <div class="container">
    <div class="right-box">

        

        <form>
            <p class="create">Create an account</p>
            <p class="account">Already have an account? <a href="#">Sign In</a></p>

            <!-- User Type -->
            <div class="user-type-selection">
                <div class="radio-item">
                    <input type="radio" id="customer" name="user_type" value="customer" checked>
                    <label for="customer">I am a Customer</label>
                </div>

                <div class="radio-item">
                    <input type="radio" id="organizer" name="user_type" value="organizer">
                    <label for="organizer">I am an Organizer</label>
                </div>
            </div>

            <!-- Name -->
            <div class="name">
                <input type="text" name="firstname" placeholder="First Name" required>
                <input type="text" name="lastname" placeholder="Last Name" required>
            </div>

            <!-- Email -->
            <div class="EmailPass">
                <input type="email" name="email" placeholder="Email" required>

                <div class="pass-wrap">
                    <input type="password" id="password" placeholder="Password" required>
                    <span class="material-symbols-outlined eye" data-target="password">visibility_off</span>
                </div>

                <div class="pass-wrap">
                    <input type="password" id="conPass" placeholder="Confirm Password" required>
                    <span class="material-symbols-outlined eye" data-target="conPass">visibility_off</span>
                </div>
            </div>

            <!-- Terms -->
            <div class="checkbox-wrap">
                <input type="checkbox" id="terms" required>
                <label for="terms">I accept the terms and conditions</label>
            </div>

            <!-- Button -->
            <div class="button">
                <button type="submit" class="createbtn">Create Account</button>
            </div>
            <!-- Divider -->
            <div class="or-divider">
                <span class="divider-line"></span>
                <span class="or-text">or register with</span>
                <span class="divider-line"></span>
            </div>

            <!-- Social -->
            <div class="social-buttons">
                <button class="social-btn">
                    <img src="https://cdn-icons-png.flaticon.com/512/300/300221.png" alt="Google">
                    <span>Google</span>
                </button>

                <button class="social-btn">
                    <img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="Facebook">
                    <span>Facebook</span>
                </button>
            </div>

        </form>

        

    </div>
</div>

<script>
    // Show / Hide Password
    document.querySelectorAll(".eye").forEach(icon => {
        icon.addEventListener("click", function () {
            const target = document.getElementById(this.dataset.target);
            if (target.type === "password") {
                target.type = "text";
                this.textContent = "visibility";
            } else {
                target.type = "password";
                this.textContent = "visibility_off";
            }
        });
    });
</script>

</body>
</html>