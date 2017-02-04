<?php include('fragments/header.php');?>
        <section class="main">
            <div class="wrapp">

                <div class="contenido">

                    <?php
                        $section = isset($_GET['section']) ? $_GET['section'] : null;
                        $sectionPath = __DIR__ . '/sections';
                        $page = $section ? '404' : 'home';
                        if ($section && file_exists($sectionPath . '/' . $section . '.php')) {
                          $page = $section;
                        }
                        include $sectionPath . '/' . $page . '.php';
                    ?>
                </div>

            </div>
        </section>
        <?php include("fragments/footer.php");?>
    </body>
</html>
