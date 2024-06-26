<!DOCTYPE html>
<html lang="en">

<?php
include 'include.php';

if (!isset($_SESSION['user_token'])) {
    header("Location: login.php");

}
?>

<head>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Křenka Služby- Nahlásit Problém</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet" />

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php

        draw_sidebar();

        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php

                draw_topbar();

                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Nahlásit Problém</h1>

                    <!-- Form Nahlásit Problém -->
                    <form class="card-body" method="POST" action="problem-nahlasen.php">

                        <!-- Dropdown Select Menu Místnost -->
                        <div class="dropdown  mb-5">
                            <label for="NahlasitProblemMistnost" class="mb-1">Vyberte prosím místnost:</label>



                            <?php

                            $sql = "SELECT trida FROM ( SELECT p.trida, MAX(r.vytvoreno) AS max_vytvoreno FROM projektory p LEFT JOIN problemy r ON r.id_projektor = p.id WHERE r.status = 't' OR r.status IS NULL GROUP BY p.id, p.trida ) AS subquery;";
                            $result = mysqli_query($conn, $sql);


                            if (mysqli_num_rows($result) > 0) {

                                echo "<select class='custom-select' name='trida' required>";

                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option>" . $row['trida'] . "</option>";
                                }

                                echo "</select>";
                            } else {
                                echo "Žádné výsledky nenalezeny";
                            }

                            mysqli_close($conn);

                            ?>


                        </div>

                        <!-- Dropdown Select Menu Zařízení -->
                        <div class="dropdown  mb-5">
                            <label for="NahlasitProblemZarizeni" class="mb-1">Vyberte prosím zařízení, u&#160kterého se vyskytl problém:</label>
                            <select class="custom-select" name="zarizeni" id="NahlasitProblemZarizeni" required>
                                <option value="1">Projektor</option>
                                <!--<option value="2">Tiskárna</option>-->
                            </select>
                        </div>

                        <!--Input Message Popište Problém-->
                        <div class='form-group'>
                            <label for='NahlasitProblemPopisteProblem' class='mb-1'>Popište prosím problém se&#160zařízením:</label>
                            <textarea type='text' class='form-control' name='popis' id='NahlasitProblemPopisteProblem' rows='7' required></textarea>
                        </div>

                        <!--Button Odeslat-->
                        <button type="submit" class="btn btn-primary">Odeslat</button>


                    </form>




                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php

                     footer();
                
                ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php
        draw_modal();
    ?>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>