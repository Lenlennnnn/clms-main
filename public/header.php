<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/bsu-lg.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="js/includes/all.min.js" rel="stylesheet">
    <link href="js/includes/bootstrap-icons.js" rel="stylesheet">

    <!-- Icons -->
    <!-- <link rel="stylesheet" href="lib/fonts/boxicons/boxicons.css" /> -->
    <link href="lib/fonts/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- DATATABLES -->
    <!-- <link href="lib/DataTables/datatables.css" rel="stylesheet"/> -->
    <link rel="stylesheet" href="lib/DataTables/datatables-bs5/datatables.bootstrap5.css">
    <link rel="stylesheet" href="lib/DataTables/datatables-responsive-bs5/responsive.bootstrap5.css">
    <link rel="stylesheet" href="lib/DataTables/datatables-checkboxes-jquery/datatables.checkboxes.css">
    <link rel="stylesheet" href="lib/DataTables/datatables-buttons-bs5/buttons.bootstrap5.css">

    <!-- Customized Bootstrap Stylesheet -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/docs.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <!-- <link href="css/darkmode.scss" rel="stylesheet"> -->
    <!-- <link href="css/core.css" rel="stylesheet"> -->

    <title>CLMS - <?php echo $currentpage ?></title>
</head>

<body>
    <script>
        //this script is to avoid the flickering when reloading the page
        let darkMode = localStorage.getItem('darkMode');
        if (darkMode === "enabled") {
            document.body.classList.add('darkmode');
        }
    </script>
    <div class="position-relative content-dark-bg d-flex p-0">
        <div class="w-100" id="maincontent">