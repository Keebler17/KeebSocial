<?php echo file_get_contents(getenv("PHP_ROOT") . "/resources/header.php"); ?>

<h1>About</h1>

<p>KeebSocial is project made as a tool to learn about full stack web development.</p>
</p>The source code is available on <a href="https://github.com/brendanjconnelly/KeebSocial">my GitHub</a>.</p>
<br>
<h2>Technical Overview</h2>
<h3>Docker</h3>
<p>Docker is a piece of software which manages containers. Containers are, according to <a href="https://www.ibm.com/topics/containers">IBM</a> <small>(external link)</small>, executable units of software that package application code along with its libraries and dependencies. They allow code to run in any computing environment, whether it be desktop, traditional IT or cloud infrastructure.
    By containerizing applications, they can be made more portable, reliable, and secure. To spin up the entire project, just one command needs to be run.
    In addition, the container environment isolates each piece of software, so they can only communicate over known protocols.
    This way, if there is a breach in the web server, which is the only part of the package that is exposed to the internet, a hacker can't do anything else except mess with the networking setup.
    The only thing the hacker can do is ask PHP to serve a dynamic webpage. If NGINX and PHP or NGINX and the database were running in the same container, a breach to one would be a breach to all.
</p>
<p>The project is made up of three separate docker containers:</p>
<h3>NGINX Container</h3>
<p>NGINX is a free and open source web server software which has been gaining increasing market share over Apache, the industry standard, in recent years.
    NGINX is responsible for handling any web requests you send, manages SSL certificates, and forwards requests to other containers when need be.
</p>
<h3>PHP Container</h3>
<p>The PHP container runs dynamic webpages in a separate container than they are served, which helps to increase the security of the entire stack.
    PHP serves as an interface between the HTML and the backend database. I have a series of API functions which can serve every single aspect of the platform.
    For example, there is a file to log in and get a session token, a file to get profile fields, and a file to get the content of a post, among many others.
</p>
<h3>MongoDB Container</h3>
<p>Everything on that platform is ultimately stored in a database called MongoDB. MongoDB is a non-relational database, meaning that it exists outside the paradigm of tables and columns.
    I've structured every object on the platform to follow a few simple formats, which have been carefully thought out to minimize the amount of reads that have to be conducted.
    While I am sacrificing to an extent storage size to fit my format, it enables the platform to be far more scalable than a traditional relational database system.
    For example, likes are stored twice: once as a list of all users who liked the post, and once as a list of all posts liked by a user.
    This represents two distinct actions that may be done, optimizing the read time for both of them. On social media platforms, reads are going to far outnumber writes, so I think this optimization saves a significant number of computing power.
</p>
<br>
<h3>API Standard</h3>
<p>I've written a bit of a standard for myself to help implement the API, which is below.</p>
<pre>
keebsocial/api/v1/AUTHORIZE.php
    user=username
    key=authentication token

    returns 0|1

keebsocial/api/v1/ACT.php
    key=authentication token
    type=POST|REPLY|REKEEB|LIKE
    content=UUID of the item to act on

    returns 0|1

keebsocial/api/v1/FOLLOW.php
    key=authentication token
    target=username to act on
    
    return 0|1|2, SUCCESS|FAILURE|REQUEST

keebsocial/api/v1/ACCEPT.php?user=user&key=key&target=target
    key=authentication token
    target=username to accept follow from
    returns 0|1

keebsocial/api/v1/GETKEEB.php
    key=authentication token
    content=uuid of keeb
    returns 0|1, text

keebsocial/api/v1/GETPROFILE.php
    key=authentication token
    target=username

    returns 0|1, username, bio, follows, followers

keebsocial/api/v1/SETPROFILE.php
    key=authentication token
    target=bio|
    content=what to set as
    

keebsocial/api/v1/GETPROFILEKEEBS.php
    key=authentication token
    target=username
    start=index of start
    end=index of end
    count=total number (if set, ignores start/end, reads from most recent)

    returns 0|1, uuids of all keebs by a user within bounds

keebsocial/api/v1/GETIMAGE.php
    key=authentication token
    content=image uuid

    returns 0|1, image if they have approval to view the parent keeb (the keeb in which the image is embedded)

keebsocial/api/v1/GETTIMELINE.php
    key=authentication token
    count=keeb count

    returns 0|1, most recent POST, REPLY, REKEEB keebs from those whom the calling user follows

keebsocial/api/v1/LOGIN.php
    user=username
    password=password
    returns 0|1, auth key

keebsocial/api/v1/LOGOUT.php
    user=username
    key=authentication token
    returns 0|1

keebsocial/api/v1/REGISTER.php
    user=username
    password=password
    returns 0|1

keebsocial/api/v1/PASSWD.php
    user=username
    old=old password
    new=new password
    returns 0|1

keebsocial/api/v2/GETNOTIFICATIONS.php
    key=authentication token

    returns 0|1, notifications
</pre>

<h3>Database Objects</h3>
<p>In addition, I've written out in plaintext a format for implementing the database:</p>
<pre>
Password Database
    users
        username
        email
        hash
        tokens
            token
            expiration

Content Databse
    users
        username
        name
        UUID
        date
        bio
        keebs
            [UUID...]
        followers
            [UUID...]
        follows
            [UUID...]
        likes
            [UUID...]
        keebs_count
        followers_count
        follows_count
        likes_count
    keebs
        UUID
        date
        content
        likes
            [UUID...]
        rekeebs
            [UUID...]
        likes_counts
        rekeebs_count
    media
        Media UUID
        Association UUID
        date
</pre>
<?php echo file_get_contents(getenv("PHP_ROOT") . "/resources/footer.php"); ?>