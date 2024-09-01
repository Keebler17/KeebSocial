/**
 * login.js
 * 
 * @requires auth.js
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
        document.cookie = "token=" + respText + "; expires=" + new Date(new Date().getTime() + (1 * 60 * 60 * 24 * 30)).toUTCString() + "; path=/";
        document.cookie = "username=" + usernameInput + "; expires=" + new Date(new Date().getTime() + (1 * 60 * 60 * 24 * 30)).toUTCString() + "; path=/";
        window.location.href = "/";
    }
}

async function register() {

}