/**
 * auth.js
 */

async function isLoggedIn() {
    // if(getCookie('username') == '') return '2';
    // if(getCookie('token') == '') return '2';

    const response = await fetch("/api/v1/AUTHORIZE.php", {
        method: 'POST',
        body: JSON.stringify(
            {
                'username': getCookie('username'),
                'token': getCookie('token')
            }
        )
    });
    const respText = await response.text();
    return respText;
}

async function logout() {
    API("/api/v1/LOGOUT.php", {
        'username': getCookie("username"),
        'token': getCookie("token")
    });

    document.cookie = "username=;expires=" + new Date(0).getUTCDate() + ";path=/";
    document.cookie = "token=;expires=" + new Date(0).getUTCDate() + ";path=/";

    location.reload();
}