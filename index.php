<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Eric Shewchuk">
    <meta name="description" content="CSE340 - Web Backend Development for Eric Shewchuk.  Use this course assignment portal for access to completed work (my portfolio)">
    <title>Eric Shewchuk - CSE340 - Web Backend Development</title>
    <link rel="stylesheet" href="styles/base.css">
</head>
<body>

    <header>
        <img src="images/thoughtfulMonkey.jpg" alt="stylized image of a monkey">
        <h1>Eric Shewchuk</h1>
        <nav>
            <a href="#">Home</a>
            <a href="chamber/siteplan.html">Site Plan</a>
            <a href="chamber/">Chamber</a>
            <a href="https://www.byui.edu/" target="_blank">BYU-Idaho</a>
            <a href="https://www.churchofjesuschrist.org/study/scriptures/pgp/moses/3?lang=eng&id=p24-p25#p24" target="_blank">Scripture</a>
        </nav>
    </header>
    <hr>
    <main>
        <h2>WDD 230: Web Frontend Development</h2>
        <section class="card">
            <?php echo '<h3>Learning Activities</h3>' ?>
            <ul>
                <li>01: <a href="lesson01/holygrail.html" target="_blank">Holy Grail Layout Assignment</a></li>
            </ul>
        </section>
        <section class="card">
            <h3>Information</h3>
            <p>Location: <span class="info">Kauai, Hawaii</span></p>
            <p>Weather: <span>- Functionality coming soon!</span></p>
            <p>Page Visits: <span>- Functionality coming soon!</span></p>
        </section>
    </main>
    <footer>
        <section class="footer">
        <p>&copy; <span id="date"></span> Eric Shewchuk - Hawaii, USA</p>
        <p>Last Modified: <span id="modified"></span></p>
        </section>
    </footer>
    <script src="scripts/primary.js"></script>   
</body>
</html>