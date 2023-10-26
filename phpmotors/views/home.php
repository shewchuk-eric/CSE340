<?php $pageTitle = "Welcome to PHP Motors, inc.";
    include_once 'header.php';
    ?>

<h1 id="content-title">Welcome to PHP Motors!</h1>

    <p id="name"><span class="bold">DMC Delorean</span><br>3 Cup holders<br>Superman doors<br>Fuzzy dice!<br></p>
    <span id="car"><img src="images/delorean.jpg" alt="image of a delorean sports car"></span>
    <button type="button" id="button">Own Today</button>

    <h4 id="upgrades">Delorean Upgrades</h4>
    <h4 id="reviews">DMC Delorean Reviews</h4>

    <section id="upgrade-card">
    <div id="one"><img src="images/flux-cap.png" alt="image of a flux capacitor"></div>
        <div id="one-p"><p>Flux Capacitor</p></div>
    <div id="two"><img src="images/flame.jpg" alt="image of a flame decal"></div>
        <div id="two-p"><p>Flame Decals</p></div>
    <div id="three"><img src="images/bumper_sticker.jpg" alt="image of a bumper sticker"></div>
        <div id="three-p"><p>Bumper Stickers</p></div>
    <div id="four"><img src="images/hub-cap.jpg" alt="image of a hub cap"></div>
        <div id="four-p"><p>Hub Caps</p></div>
    </section>

    <ul id="reviews-list">
        <li>"So fast it's almost like traveling in time." (4/5)</li>
        <li>"Coolest ride on the road." (4/5)</li>
        <li>"I'm feeling Marty McFly!" (5/5)</li>
        <li>"The most futuristic ride of our day." (4.5/5)</li>
        <li>"80's livin and I love it!" (5/5)</li>
    </ul>

<?php include_once 'footer.php'; ?>