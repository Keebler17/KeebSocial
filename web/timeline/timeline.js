var dbPostsCount = -1;

async function initTimeline(users) {
    dbPostsCount = await API("/api/v1/GETPOSTS.php", {
        user: getCookie("username"),
        key: getCookie("token"),
        feed: users
    });

    for(let i = 0; i < dbPostsCount; i++) {
        let resp = await API("/api/v1/GETPOSTS.php", {
            user: getCookie("username"),
            key: getCookie("token"),
            feed: users,
            index: 0
        });
        console.log(resp);
    }
}



async function getFeed() {

}

async function toHTML(postobject) {
    
}