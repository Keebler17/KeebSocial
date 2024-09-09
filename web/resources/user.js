async function init() {
    setupFollowButton();
    
    // Banner elements to fill:
    // display name, user handle, bio, profile picture
    document.getElementById("profile_username").innerHTML = await getDisplayName();
    document.getElementById("profile_handle").innerHTML = "@" + getParam("name");
    document.getElementById("profile_bio").innerHTML = await getBio();


}


async function getDisplayName() {
    return getUserField('name');
}

async function getBio() {
    return getUserField('bio');
}
async function getUserField(field, user = null) {
    if(user == null) {
        user = getParam("name");
    }
    let resp = await API("/api/v1/GETPROFILE.php", {
        key: getCookie("token"),
        user: getCookie("username"),
        target: user,
        field: field
    });
    return resp;
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
    if(getCookie("username") == getParam("name")) {
        document.getElementById("profile_follow").style = "display: none";
        document.getElementById("profile_unfollow").style = "display: none";
    } else if(await checkFollow()) {
        document.getElementById("profile_follow").style = "display: none";
        document.getElementById("profile_unfollow").style = "display: inline-block";
    } else {
        document.getElementById("profile_follow").style = "display: inline-block";
        document.getElementById("profile_unfollow").style = "display: none";
    }
}