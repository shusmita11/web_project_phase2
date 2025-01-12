function validateLoginForm(email, password, userType) {
        // Validate email
        const validateEmail = email => email.length !== '';

        // Validate password (at least 8 characters)
        const validatePassword = password => password.length !== '';

        // Validate userType (not empty)
        const validateUserType = userType => userType !== '';

        if (validateEmail(email) && validatePassword(password) &&validateUserType(userType))
        {
            return true;
        }

        return false;
    }
    
    function confirmLogin()
    {
            const email = document.getElementById("email").value.trim();
            const password = document.getElementById("password").value.trim();
            const userType = document.querySelector('select[name="userType"]').value;
    
            // Validate the form inputs
            if (!validateLoginForm(email, password, userType)) {
                alert("Invalid input. Please ensure all fields are correctly filled.");
                return;
            }
    
            // Prepare the data for AJAX
            const loginData = JSON.stringify({
                email: email,
                password: password,
                userType: userType
            });

            alert(loginData);
    
            // AJAX request
            const xhttp = new XMLHttpRequest();
            xhttp.open("POST", "../controller/loginCheck.php", true);
            console.log('flag 1');
            xhttp.setRequestHeader("Content-type", "application/json");
            xhttp.send(loginData);
    
            xhttp.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    console.log("Server response:", this.responseText);
                    const response = this.responseText.trim();
    
                    if (response === "patient") {
                        alert("Login successful! Redirecting to patient dashboard...");
                        window.location.href = "../view/patientDashboard.php";
                    } else if (response === "doctor") {
                        alert("Login successful! Redirecting to doctor dashboard...");
                        window.location.href = "../view/doctorDashboard.php";
                    } else if (response === "admin") {
                        alert("Login successful! Redirecting to admin dashboard...");
                        window.location.href = "../view/adminDashboard.php";
                    } else {
                        alert("Error: " + response);
                    }
                }
            };
        }
    
