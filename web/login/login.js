/**
 * login.js
 * 
 * @requires auth.js
 * 
 * refactor this a bit lol
 */

async function login() {
    let usernameInput = document.getElementById("username").value;
    const response = await fetch("/api/v1/LOGIN.php", {
        method: "POST",
        body: JSON.stringify(
            {
                username: usernameInput,
                password: document.getElementById("password").value
            }
        )
    });

    let respText = await response.text();

    if(respText == '1') document.getElementById("login_result").innerHTML = "Login failed. User does not exist.";
    else if(respText == '0') document.getElementById("login_result").innerHTML = "Login failed. Incorrect password.";
    else { // Successful login
        document.getElementById("login_result").innerHTML = "";
        document.cookie = "token=" + respText + "; expires=" + new Date(new Date().getTime() + (1000 * 60 * 60 * 24 * 30)).toUTCString() + "; path=/";
        document.cookie = "username=" + usernameInput + "; expires=" + new Date(new Date().getTime() + (1000 * 60 * 60 * 24 * 30)).toUTCString() + "; path=/";
        window.location.href = "/";
    }
}

async function register() {
    let resp = await API("/api/v1/REGISTER.php", {
        username: document.getElementById("newusername").value,
        name: document.getElementById('newfullname').value,
        password: document.getElementById("newpassword").value
    });

    if(resp == '1') {
        document.getElementById("register_result").innerHTML = "Unknown error.";
    } else if(resp == '2') {
        document.getElementById("register_result").innerHTML = "User already exists.";
    } else {
        document.getElementById("register_result").innerHTML = "Creating user...";
    }
    
    let loginResp = await API("/api/v1/LOGIN.php", {
        username: document.getElementById("newusername").value,
        password: document.getElementById("newpassword").value
    });

    if(loginResp == '1') document.getElementById("login_result").innerHTML = "Login failed. User does not exist.";
    else if(loginResp == '0') document.getElementById("login_result").innerHTML = "Login failed. Incorrect password.";
    else {
        document.getElementById("login_result").innerHTML = "";
        document.cookie = "token=" + loginResp + "; expires=" + new Date(new Date().getTime() + (1000 * 60 * 60 * 24 * 30)).toUTCString() + "; path=/";
        document.cookie = "username=" + document.getElementById("newusername").value + "; expires=" + new Date(new Date().getTime() + (1000 * 60 * 60 * 24 * 30)).toUTCString() + "; path=/";
        window.location.href = "/";
    }
}