<?php
require_once './config/database.php';
require_once './models/db.php';
require_once './models/manufacture.php';
require_once './models/protype.php';
require_once './models/product.php';

$Manufactures = new Manufacture();
$Protypes = new Protype();
$Product = new Product();

$protype_id = $_GET['id'];
$protype = $Protypes->getProtypesById($protype_id);

if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $image = $protype[0]['type_image']; // Use the existing image by default

    // Check if a new file has been uploaded
    if (isset($_FILES['fileUpload']) && $_FILES['fileUpload']['error'] === 0) {
        $fileUpload = $_FILES['fileUpload'];
        move_uploaded_file($fileUpload['tmp_name'], './images/' . $fileUpload['name']);
        $image = $fileUpload['name']; // Use the new image
    }

    $Protypes->updateProtypes($protype_id, $name, $image);
    header('Location: protypes.php');
}
?>

<h1>
    Edit_protype
</h1>

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

<!-- BEGIN USER FORM -->
<form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label">Name :</label>
        <div class="controls">
            <input type="text" class="span11" placeholder="Product name" name="name"
                value="<?php echo $protype[0]['type_name'] ?>" /> *
            <img style="width:100px" src="./images/<?php echo $protype[0]['type_image'] ?>" alt="">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Choose
            another logo :</label>
        <div class="controls">
            <input type="file" name="fileUpload" id="fileUpload">
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-success">Update</button>
    </div>
</form>