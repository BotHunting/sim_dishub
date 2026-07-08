<?php
include("header.php"); // Includes session and DB connection from ../assets/config.php

// Check if ID is provided and is a number
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    // Redirect if ID is not valid
    header("Location: trainers.php");
    exit();
}

$id = (int)$_GET['id'];

// Handle form submission for deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_delete'])) {
    // Prepare a delete statement to prevent SQL injection
    $sql = "DELETE FROM pegawai_pkb WHERE id = ?";

    if ($stmt = $koneksi->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $id);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Redirect to trainers page on success
            header("Location: trainers.php?status=deleted");
            exit();
        } else {
            // If deletion fails, show an error
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        $stmt->close();
    }
}

// Fetch employee data to display in the confirmation message
$sql_fetch = "SELECT nama FROM pegawai_pkb WHERE id = ?";
$pegawai_nama = "pegawai ini"; // Default name
if ($stmt_fetch = $koneksi->prepare($sql_fetch)) {
    $stmt_fetch->bind_param("i", $id);
    if ($stmt_fetch->execute()) {
        $result = $stmt_fetch->get_result();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $pegawai_nama = htmlspecialchars($row['nama']);
        } else {
            // Pegawai not found, redirect to the list
            header("Location: trainers.php");
            exit();
        }
    }
    $stmt_fetch->close();
}

$koneksi->close();
?>

<main class="main">
    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Hapus Pegawai</h1>
                        <p class="mb-0">Konfirmasi penghapusan data pegawai.</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="trainers.php">Pegawai</a></li>
                    <li class="current">Hapus Pegawai</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <div class="container mt-5">
        <div class="alert alert-warning text-center">
            <h2>Konfirmasi Hapus</h2>
            <p>Apakah Anda yakin ingin menghapus data pegawai: <strong><?php echo $pegawai_nama; ?></strong>?</p>
            <p>Tindakan ini tidak dapat dibatalkan.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id=<?php echo $id; ?>" method="post">
                <input type="hidden" name="confirm_delete" value="1">
                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                <a href="trainers.php" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</main>

<?php include("footer.php"); ?>
