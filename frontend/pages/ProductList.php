<?php
    /**
     * @var array $products
     */
?>
<form id = "DeleteFrom" action="/deleteProduct" method="post">
<div class="row">
    <main class="col align-self-start">
        <div class="d-flex justify-content-between col align-self-start align-items-center pt-3 pb-2 mb-4 border-bottom">
            <h3>Product List</h3>
            <div>
                <a class="btn btn-primary" href="/addProduct">ADD</a>
                <button id="delete-product-btn" class="btn btn-danger ms-4">MASS DELETE</button>
            </div>
        </div>
            <div class="product row mb-5">
                <?php foreach ($products as $product){ ?>
                <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                    <div class="card border-dark border-3 fs-5">
                        <div class="card-body">
                            <input type="checkbox" name="checklist[]" class="delete-checkbox form-check-input border-dark" value="<?=$product['id']?>">
                            <p class="card-title text-center mb-0"><?= $product['sku']?></p>
                            <P class="card-text text-center mb-0"><?= $product['name']?></P>
                            <P class="card-text text-center mb-0"><?= number_format($product['price'], 2) ?> $</P>
                            <p class="card-text text-center">
                                <?php
                                    if($product['type'] === 'dvd')
                                    {
                                        echo 'Size: ' . $product['size'] . ' MB';
                                    } elseif ($product['type'] === 'book') {
                                        echo 'Weight: ' . $product['weight'] . ' KG';
                                    } else {
                                        echo 'Dimensions: ' . $product['height'] . 'x' . $product['width'] . 'x' . $product['length'] ;
                                    } ?>
                            </p>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
</main>
</div>
</form>
<script src="frontend/assets/js/ProductList.js"></script>