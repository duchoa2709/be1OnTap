<?php
require_once './config/database.php';
require_once './models/db.php';
require_once './models/manufacture.php';
require_once './models/protype.php';
require_once './models/product.php';

$Manufacture = new Manufacture();
$Protypes = new Protype();
$Product = new Product();

$getAllManu = $Manufacture->getAllManu();
?>

<h1>
    IN TẤT CẢ MANUFACTURE
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
            <th></th>
            <th>Manu Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($getAllManu as $value) : ?>
        <tr class="">
            <td><img src="./images/<?php echo $value['manu_image'] ?>" style="width: 100px; height: 100px;"></td>
            <td>
                <?php echo $value['manu_name']; ?>
            </td>

            <td>
                <!-- button edit, delete -->
                <a href="edit_manu.php?id=<?php echo $value['manu_id'] ?>" class="btn btn-success">Edit</a>

                <form action="delete_manu.php" method="post">
                    <input type="hidden" name="manu_id" value="<?php echo $value['manu_id'] ?>">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="row" style="margin-left: 18px;">
    <ul class="pagination">
        <li class="active">1</li>
        <li>2</li>
        <li>3</li>
    </ul>
</div>
<!-- END CONTENT -->