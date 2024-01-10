<?php
require_once './config/database.php';
require_once './models/db.php';
require_once './models/manufacture.php';
require_once './models/protype.php';
require_once './models/product.php';


$Manufactures = new Manufacture();
$Protypes = new Protype();
$Product = new Product();

$manu_id = $_GET['id'];
$manu = $Manufactures->getManufactureById($manu_id);

if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $image = $manu[0]['manu_image']; // Use the existing image by default

    // Check if a new file has been uploaded
    if (isset($_FILES['fileUpload']) && $_FILES['fileUpload']['error'] === 0) {
        $fileUpload = $_FILES['fileUpload'];
        move_uploaded_file($fileUpload['tmp_name'], './images/' . $fileUpload['name']);
        $image = $fileUpload['name']; // Use the new image
    }

    $Manufactures->updateManufacture($manu_id, $name, $image);
    header('Location: manufactures.php');
}
?>

<!--sidebar-menu-->
<ul>
    <li>
        <a href="index.php"><i class="icon icon-home"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li>
        <a href="manufactures.php"><i class="icon icon-th-list"></i>
            <span>Manufactures</span>
        </a>
    </li>
    <li>
        <a href="protypes.php"><i class="icon icon-th-list"></i>
            <span>Product type</span>
        </a>
    </li>
</ul>
<!-- end sidebar -->

<h1>Edit_manu</h1>
<!-- BEGIN USER FORM -->
<form action="" method="post" class="form-horizontal" enctype="multipart/form-data">

    <div class="control-group">
        <label class="control-label">Name :</label>
        <div class="controls">
            <input type="text" class="span11" placeholder="Product name" name="name"
                value="<?php echo $manu[0]['manu_name'] ?>" /> *
            <img style="width:100px" src="./images/<?php echo $manu[0]["manu_image"] ?>" alt="">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Choose another logo :</label>
        <div class="controls">
            <input type="file" name="fileUpload" id="fileUpload">
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-success">Update</button>
    </div>
</form>
<!-- END USER FORM -->