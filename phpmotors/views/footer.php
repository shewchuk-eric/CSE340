</main>
    <footer>
        <section class="footer">
        <p>&copy; <span id="date"></span> PHP Motors, All rights reserved.</p>
        <p>All images used are believed to be in "Fair Use".  Please notify the author if any are not and they will be removed</p>
        <p>Last Updated: <span id="modified"></span></p>
        </section>
    </footer>
    <?php if ($pageTitle === "Welcome to PHP Motors, inc.") {
        $source = "scripts/motors.js";
    } else {
            $source = "../scripts/motors.js";
        } ?>

    <script src="<?php echo $source ?>"></script>
</body>
</html>