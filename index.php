<?php
require './helpers/dbConnection.php';

# Fetch Roes Data .......
$sql = 'select * from uploading';
$op = mysqli_query($con, $sql);

?>

<!doctype html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <title>Ajax File Upload with jQuery and PHP</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css"/>
</head>

<body>


    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>File Uploading with Ajax</h1>

                <table id="table" class="table table-sm table-image">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Image</th>
                            <th scope="col">File Name</th>
                            <th scope="col" class="text-center">Actino</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        # Fetch Data ...... 
                        while ($data = mysqli_fetch_assoc($op)) {
                        ?>
                            <tr>
                                <th scope="row"><?php echo $data['id']; ?></th>
                                <td class="w-25" style="width: 160px;">
                                    <img src="<?php echo $data['path']; ?>" class="img-fluid img-thumbnail" alt="Sheep">
                                </td>
                                <td><?php echo $data['name']; ?></td>
                                <td class="text-center">

                                    <button id="icon-approval" type="button" onclick="actionImage(this,<?php echo $data['id']; ?>, 'approval');"></button>

                                    <button id="icon-rejection" type="button" onclick="actionImage(this,<?php echo $data['id']; ?>, 'rejection');"></button>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>

                    </tbody>
                </table>
            </div>


            <div class="col-12">

                <h3>Uploading..</h3>
                <hr>
                <div id="message"></div>

                <form id="form" method="post" action="" enctype="multipart/form-data">
 
                    <div class="container">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">File Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">File </label>
                                    <input type="file" id="uploadImage" accept="image/*" name="image" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input class="btn btn-success mb-5" type="submit" value="Upload">

                </form>

            </div>
        </div>
    </div>

    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/mohamedgohar.js"></script>
</body>

</html>