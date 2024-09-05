async function init() {
    setupFollowButton();
    
}

async function follow() {
    let resp = await API("/api/v1/FOLLOW.php", {
        key: getCookie("token"),
        user: getCookie("username"),
        target: getParam("name")
    });
    setupFollowButton();
}

async function unfollow() {
    let resp = await API("/api/v1/FOLLOW.php", {
        key: getCookie("token"),
        user: getCookie("username"),
        target: getParam("name"),
        follow: 0
    });
    console.log(resp);
    setupFollowButton();
}

async function checkFollow() {
    let resp = await API("/api/v1/FOLLOWQUERY.php", {
        key: getCookie("token"),
        user: getCookie("username"),
        target: getParam("name")
    });
    return (resp == 1);
}


async function setupFollowButton() {
    if(await checkFollow()) {
        document.getElementById("profile_follow").style = "display: none";
        document.getElementById("profile_unfollow").style = "display: inline-block";
    } else {
        document.getElementById("profile_follow").style = "display: inline-block";
        document.getElementById("profile_unfollow").style = "display: none";
    }
}