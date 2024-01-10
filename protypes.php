<?php
require_once './config/database.php';
require_once './models/db.php';
require_once './models/manufacture.php';
require_once './models/protype.php';
require_once './models/product.php';

$Manufacture = new Manufacture();
$Protypes = new Protype();
$Product = new Product();

$getAllProtypes = $Protypes->getAllProtypes();

if (isset($_POST['type_id'])) {
    $type_id = $_POST['type_id'];
    $Protypes->deleteProtypes($type_id);
    header('Location: protypes.php');
}
?>

<h1>
    QUẢN LÝ PROTYPE
</h1>

<!--start-top-serch-->
<div id="search">
    <form action="result.php" method="get">
        <input type="text" placeholder="Search here..." name="keyword" />
        <button type="submit" class="tip-bottom" title="Search">+</button>
    </form>
</div>
<!--close-top-serch-->

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

<table>
    <thead>
        <tr>
            <th>Manu Id</th>
            <th>Manu Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($getAllProtypes as $value) : ?>
        <tr class="">
            <td>
                <img src="./images/<?php echo $value['type_image'] ?>" style="width: 100px; height: 100px;">
            </td>
            <td><?php echo $value['type_name'] ?></td>

            <td>
                <a href="edit_protype.php?id=<?php echo $value['type_id'] ?>" class="btn btn-success">Edit</a>

                <form action="" method="post">
                    <input type="hidden" name="type_id" value="<?php echo $value['type_id'] ?>">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>

        <?php endforeach; ?>
    </tbody>
</table>