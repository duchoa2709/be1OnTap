<?php
require_once './config/database.php';
require_once './models/db.php';
require_once './models/manufacture.php';
require_once './models/protype.php';
require_once './models/product.php';

$Manufacture = new Manufacture();
$Protypes = new Protype();
$Product = new Product();

$manufactures = $Manufacture->getAllManu();
$protypes = $Protypes->getAllProtypes();

// search
$limit = 5;

$search = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page > 1) ? ($page - 1) * $limit : 0;

$getProductsList = $Product->searchAndPagination($search, $limit, $start);
$countProducts = count($Product->searchProducts($search));
$total_page = ceil($countProducts / $limit);
?>


<!--start-top-serch-->
<div id="search">
    <form action="result.php" method="get">
        <input type="text" placeholder="Search here..." name="keyword" value="<?php echo $_GET['keyword'] ?>" />
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

<h6>Result: keyword '<?php echo $_GET['keyword']?>'</h6>

<table>
    <thead>
        <tr>
            <th>img</th>
            <th>Name</th>
            <th>Manufactures</th>
            <th>Product type</th>
            <th>Description</th>
            <th>Price (VND)</th>
            <th>Feature</th>
            <th>Created at</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($getProductsList as $key => $product): ?>
        <tr>
            <!-- img -->
            <td>
                <img src="./images/<?php echo $product['pro_image'] ?>" alt="">
            </td>

            <!-- name -->
            <td>
                <p class="product-name">
                    <a href="product.php?id=<?php echo $product['id'] ?>">
                        <?php echo $product['name'] ?>
                    </a>
                </p>
            </td>

            <!-- manufacture -->
            <td>
                <?php $manufactures = $Manufacture->getManufactureById($product['manu_id']); ?>
                <?php foreach($manufactures as $manufacture): ?>
                <p class="product-category"><?php echo $manufacture['manu_name'] ?></p>
                <?php endforeach; ?>
            </td>

            <!-- protype -->
            <td>
                <?php $productTypes = $Protypes->getProtypesById($product['type_id']); ?>
                <?php foreach($productTypes as $type): ?>
                <p class="product-category"><?php echo $type['type_name'] ?></p>
                <?php endforeach; ?>
            </td>

            <!-- description -->
            <td>
                <p class="product-category"><?php echo $product['description'] ?></p>
            </td>

            <!-- price -->
            <td>
                <h4 class="product-price">
                    <?php echo number_format($product['price']) ?>VNĐ
                </h4>
            </td>

            <!-- feature -->
            <td>
                <p class="product-category">
                    <?php echo $product['feature'] ?>
                </p>
            </td>

            <!-- created_at -->
            <td>
                <p class="product-category">
                    <?php echo $product['created_at'] ?>
                </p>
            </td>

            <!-- action -->
            <form action="" method="POST">
                <td>
                    <a href="edit.php?id=<?php echo $product['id'] ?>" class="btn btn-success btn-mini">Edit</a>
                    <a href="delete.php?id=<?php echo $product['id'] ?>" class="btn btn-danger btn-mini">Delete</a>
                </td>
            </form>

            <!-- Add other columns as needed -->
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="row" style="margin-left: 18px;">
    <ul class="pagination">
        <?php for ($i = 1; $i <= $total_page; $i++) : ?>
        <?php if ($i == $page) : ?>
        <?php echo '<li class="active"><a href="result.php?page=' . $i . '&keyword=' . $_GET['keyword'] . '">' . $i . '</a></li>' ?>
        <?php else : ?>
        <?php echo '<li><a href="result.php?page=' . $i . '&keyword=' . $_GET['keyword'] . '">' . $i . '</a></li>' ?>
        <?php endif; ?>
        <?php endfor; ?>
    </ul>
</div>