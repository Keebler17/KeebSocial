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
        document.getElementById("posts").appendChild(post);
    }
}



async function getFeed() {
    feed = await API("/api/v1/FEEDQUERY.php", {
        user: getCookie("username"),
        field: "follows"
    });
    return JSON.parse(feed);
}


async function toHTML(postobject) {
    post = document.createElement("div");
    post.setAttribute("id", postobject.uuid);
    post.setAttribute("class", "post");


    // info banner
    

    bannerDiv = document.createElement("div");
    bannerDiv.setAttribute("class", "postbanner"); 

    permalink = document.createElement("a");
    permalink.setAttribute("href", "/viewpost.php?id=" + postobject.uuid);

    // profile picture
    // i forget why i made tis a container div but there's probably a reason
    iconDiv = document.createElement("div");
    iconDiv.style.display = "inline";

    icon = document.createElement("img");
    icon.setAttribute("src", "https://dummyimage.com/64/64/fff");
    icon.setAttribute("class", "postico");
    iconDiv.appendChild(icon);

    permalink.appendChild(iconDiv);
    
    // name
    author = document.createElement("span");
    author.setAttribute("class", "author");
    author.innerHTML = await getUserField("name", postobject.author);
    permalink.appendChild(author);

    // handle
    handle = document.createElement("span");
    handle.setAttribute("class", "handle");
    handle.innerHTML = "@" + postobject.author;
    permalink.appendChild(handle);

    // time
    date = document.createElement("span");
    date.setAttribute("class", "date");
    date.innerHTML = new Date(postobject.date * 1000).toLocaleString();
    permalink.appendChild(date);

    // options (if the current user is the post author)
    optionsDiv = document.createElement("div");
    optionsDiv.style.display = "inline";

    if(postobject.author == getCookie("username")) {
        options = document.createElement("img");
        options.setAttribute("src", "/resources/content/options.png");
        options.setAttribute("class", "postoptions");
        options.setAttribute("uuid", postobject.uuid);
        options.setAttribute("onclick", "menuClick(this)");

        optionsDiv.appendChild(options);
        bannerDiv.appendChild(optionsDiv);
        bannerDiv.appendChild(menuFactory(postobject.uuid));
    }

    bannerDiv.appendChild(permalink);
    post.appendChild(bannerDiv);


    // content
    content = document.createElement("p");
    content.innerHTML = postobject.content;
    post.appendChild(content);

    // first level replies
    replies = document.createElement("div");
    
    return post;

}

// Called by viewpost.php
async function viewpost() {
    resp = await API("/api/v1/GETPOSTS.php", {
        user: getCookie("username"),
        key: getCookie("token"),
        uuid: getParam("id")
    });

    obj = await toHTML(JSON.parse(resp));
    document.getElementById("posts").appendChild(obj);
}

function menuClick(e) {
    let uuid = e.getAttribute("uuid");

    document.getElementById(uuid).children[0].children[1].style.display = "inline";
}

// do people do this in JS?
function menuFactory(uuid) {
    menuDiv = document.createElement("div");
    menuDiv.setAttribute("class", "menuOptions");
    menuDiv.setAttribute("uuid", uuid);

    menuDiv.style.display = "none";

    optDelete = document.createElement("div");
    optDelete.setAttribute("class", "menuOption");
    deleteText = document.createElement("span");
    deleteText.setAttribute("class", "deleteText");
    deleteText.innerHTML = "Delete";



    optDelete.appendChild(deleteText);
    menuDiv.appendChild(optDelete);
    return menuDiv;
}