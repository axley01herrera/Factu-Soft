<?php echo view('layouts/header'); ?>

<body>
    <!-- App Modal -->
    <div id="app-modal"></div>
    <div id="main-wrapper">
        <!-- Side Bar -->
        <?php echo view('layouts/sideBar'); ?>
        <div class="page-wrapper">
            <!-- Top Bar -->
            <?php echo view('layouts/topBar'); ?>
            <div class="body-wrapper">
                <div class="container-fluid">
                    <!-- page -->
                    <?php echo view($page); ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll(".sidebartoggler").forEach(function(element) {
            element.addEventListener("click", function(e) {
                e.preventDefault();

                document.querySelectorAll(".sidebartoggler").forEach(function(el) {
                    el.checked = true;
                });

                document.getElementById("main-wrapper").classList.toggle("show-sidebar");

                document.querySelectorAll(".sidebarmenu").forEach(function(el) {
                    el.classList.toggle("close");
                });

                let dataTheme = document.body.getAttribute("data-sidebartype");
             
                if (dataTheme == "full" || dataTheme == "null" || dataTheme == null) {
                    document.body.setAttribute("data-sidebartype", "mini-sidebar");
                } else {
                    document.body.setAttribute("data-sidebartype", "full");
                }
            });
        });
    </script>
</body>

</html>