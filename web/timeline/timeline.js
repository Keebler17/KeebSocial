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
            index: i
        });
        let post = await toHTML(JSON.parse(resp));
        console.log(JSON.parse(resp));
        document.getElementById("posts").appendChild(post);
    }
}



async function getFeed() {

}

async function toHTML(postobject) {
    post = document.createElement("div");
    post.setAttribute("id", postobject.uuid);
    post.setAttribute("class", "post");

    bannerDiv = document.createElement("div");
    bannerDiv.setAttribute("class", "postbanner"); 

    icon = document.createElement("img");
    icon.setAttribute("src", "https://dummyimage.com/64/64/fff");
    icon.setAttribute("class", "postico");
    bannerDiv.appendChild(icon);
    
    author = document.createElement("span");
    author.setAttribute("class", "author");
    author.innerHTML = postobject.author;
    bannerDiv.appendChild(author);

    handle = document.createElement("span");
    handle.setAttribute("class", "handle");
    handle.innerHTML = "@" + await getUserField("name", postobject.author);
    bannerDiv.appendChild(handle);

    date = document.createElement("span");
    date.setAttribute("class", "date");
    date.innerHTML = new Date(postobject.date * 1000).toLocaleString();
    bannerDiv.appendChild(date);

    post.appendChild(bannerDiv);

    content = document.createElement("p");
    content.innerHTML = postobject.content;
    post.appendChild(content);
    return post;
}