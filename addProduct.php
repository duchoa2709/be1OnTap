<?php
require_once './config/database.php';
require_once './models/db.php';
require_once './models/manufacture.php';
require_once './models/protype.php';
require_once './models/product.php';


$Manufacture = new Manufacture();
$Protypes = new Protype();
$Product = new Product();

$getAllProducts = $Product->getAllProducts();
$getAllManu = $Manufacture->getAllManu();
$getAllProtypes = $Protypes->getAllProtypes();

if (isset($_POST['name'], $_POST['manu_id'], $_POST['type_id'], $_POST['description'], $_POST['price'], $_POST['feature'])) {
    $created_at = date("Y-m-d H:i:s");
    $target_dir = "./images/";
    $target_file = $target_dir . basename($_FILES["fileUpload"]["name"]);
    $image = basename($_FILES["fileUpload"]["name"]);

    if (getimagesize($_FILES["fileUpload"]["tmp_name"]) !== false) {
        if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
            echo "The file " . $image . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "File is not an image.";
    }

    if ($Product->addProduct($_POST['name'], $_POST['manu_id'], $_POST['type_id'], $_POST['description'], $_POST['price'], $image, $_POST['feature'], $created_at)) {
        header("Location: index.php");
    }
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

<h1>
    THÊM PRODUCT
</h1>
<!-- BEGIN USER FORM -->
<form action="" method="post" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label">Name :</label>
        <div class="controls">
            <input type="text" class="span11" placeholder="Product name" name="name" required />
            *
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Choose a
            manufacture:</label>
        <div class="controls">
            <select name="manu_id" id="cate">
                <?php foreach ($getAllManu as $key => $value) { ?>
                <option value="<?php echo $value['manu_id'] ?>">
                    <?php echo $value['manu_name'] ?></option>
                <?php } ?>
            </select> *
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Choose a
            product type:</label>
        <div class="controls">
            <select name="type_id" id="subcate">
                <?php 
                    foreach ($getAllProtypes as $key => $value) : ?>
                <option value="<?php echo $value['type_id'] ?>">
                    <?php echo $value['type_name'] ?></option>
                <?php endforeach; ?>
            </select> *
        </div>
        <div class="control-group">
            <label class="control-label">Choose
                an image :</label>
            <div class="controls">
                <input type="file" name="fileUpload" id="fileUpload" required>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Description</label>
            <div class="controls">
                <textarea class="span11" placeholder="Description" name="description" required></textarea>
            </div>
            <div class="control-group">
                <label class="control-label">Price
                    :</label>
                <div class="controls">
                    <input type="number" class="span11" placeholder="price" name="price" required />
                    *
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Feature
                    :</label>
                <div class="controls">
                    <input type="number" class="span11" name="feature" min="0" max="1" required /> *
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-success">Add</button>
            </div>
        </div>
    </div>
</form>