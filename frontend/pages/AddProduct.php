<?php
/**
 * @var $model Product
 */
?>

<form class="mo" name="Form" method="POST" id="product_form" autocomplete="off">
    <div class="d-flex justify-content-between col align-self-start align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3>Product Add</h3>
        <div>
            <button class="btn btn-primary" type="submit" name="submit">Save</button>
            <a class="btn btn-secondary ms-4" href = "/">Cancel</a>
        </div>
    </div>
    <?php foreach ($model->errors as $error) { ?>
    <div class="row">
        <div class="col-lg-2 col-md-3 col-sm-4"></div>
        <div class="alert alert-danger col-lg-6 col-md-9 col-sm-8" role="alert">
            <label><?= $error[0]; ?></label>
        </div>
    </div>
    <?php } ?>
    <!--SKU input field-->
    <div class="row mt-1">
        <div class="col-lg-2 col-md-3 col-sm-4">
            <label for="sku" class="form-label w-100 fs-4 bg-transparent">SKU</label>
        </div>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <input value="<?= $model->{'sku'} ?>" required type="text" name="sku" class="form-control <?= $model->hasError('sku') ? 'is-invalid' : ''; ?>" id="sku" placeholder="SKU">
            <p>Product Sku should be required, unique, no #$%^& characters.</p>
            <div class="invalid-feedback" style="display: block">
                <?php echo $model->getFirstError('sku');?>
            </div>
        </div>
    </div>
    <!--Name input field-->
    <div class="row mt-3">
        <div class="col-lg-2 col-md-3  col-sm-4">
            <label for="name" class="form-label w-100 fs-4 bg-transparent">Name </label>
        </div>
        <div class="col-lg-6 col-md-9  col-sm-8">
            <input value="<?= $model->{'name'} ?>" required placeholder="Name" type="text" name="name" class="form-control <?= $model->hasError('name') ? 'is-invalid' : ''; ?>" id="name">
            <p>Product name must not contain special characters (!@#$%^&*()<>?).</p>
            <div class="invalid-feedback" style="display: block">
                <?php echo $model->getFirstError('name');?>
            </div>
        </div>
    </div>
    <!--Price input field-->
    <div class="row mt-3">
        <div class="col-lg-2 col-md-3  col-sm-4">
            <label for="price" class="form-label w-100 fs-4 bg-transparent">Price ($) </label>
        </div>
        <div class="col-lg-6 col-md-9  col-sm-8">
            <input value="<?= $model->{'price'} ?>" required placeholder="Price" type="text" name="price" class="form-control <?= $model->hasError('price') ? 'is-invalid' : ''; ?>" id="price">
            <p>Only numbers allowed for Product Price.</p>
            <div class="invalid-feedback" style="display: block">
                <?php echo $model->getFirstError('price');?>
            </div>
        </div>
    </div>
    <!--Type Selector-->
    <div class="row mt-3">
        <!--Selector Label-->
        <div class="col-lg-2 col-md-3  col-sm-4">
            <label for="productType" class="form-label w-100 fs-4 bg-transparent">Type Switcher </label>
        </div>
        <!--Selector Input-->
        <div class="col-lg-6 col-md-9  col-sm-8">
            <select title="Press to select type" id="productType" required name="type" class="form-control <?= $model->hasError('type') ? 'is-invalid' : ''; ?> ">
                <option disabled selected value="">Type Switcher</option>
                <option id="DVD" value="dvd">DVD</option>
                <option id="Book" value="book">Book</option>
                <option id="Furniture" value="furniture">Furniture</option>
            </select>
            <div class="invalid-feedback" style="display: block">
                <?php echo $model->getFirstError('type');?>
            </div>
        </div>
    </div>
    <!--DVD select option-->
    <div id="DVD" style="display: none;" class="type">
        <div class="row mt-4 ">
            <div class="col-lg-2 col-md-3 col-sm-4">
                <label for="size" class="form-label w-100 fs-4 bg-transparent">Size (MB) </label>
            </div>
            <div id="dep" class="col-lg-6 col-md-9 col-sm-8">
                <input value="<?php echo ($model->{'size'}) ?? ''; ?>" required placeholder="Enter Dvd Size" type="text" name="size" class="form-control <?= $model->hasError('size') ? 'is-invalid' : ''; ?>" id="size">
                <p>Only numbers allowed for Product Size.</p>
                <div class="invalid-feedback" style="display: block">
                    <?php echo $model->getFirstError('size');?>
                </div>
                <label class="attribute">Please Provide Product Size</label>
            </div>
        </div>
        <h4 class="mt-4">"Product Description"</h4>
    </div>
    <!--Furniture select option-->
    <div id="Furniture" class="type" style="display: none;">
        <!--Height-->
        <div class="row mt-3">
            <div class="col-lg-2 col-md-3  col-sm-4">
                <label for="height" class="form-label w-100 fs-4 bg-transparent">Height (CM) </label>
            </div>
            <div class="col-lg-6 col-md-9  col-sm-8">
                <input value="<?php echo ($model->{'height'}) ?? ''; ?>" required placeholder="Enter Furniture Height" type="text" name="height" class="form-control <?= $model->hasError('height') ? 'is-invalid' : ''; ?>" id="height">
                <p>Only numbers allowed for Product Height.</p>
                <div class="invalid-feedback" style="display: block">
                    <?php echo $model->getFirstError('height');?>
                </div>
            </div>
        </div>
        <!--Width-->
        <div class="row mt-3">
            <div class="col-lg-2 col-md-3  col-sm-4">
                <label for="width" class="form-label w-100 fs-4 bg-transparent">Width (CM) </label>
            </div>
            <div class="col-lg-6 col-md-9  col-sm-8">
                <input value="<?php echo ($model->{'width'}) ?? ''; ?>" required placeholder="Enter Furniture Width" type="text" name="width" class="form-control <?= $model->hasError('width') ? 'is-invalid' : ''; ?>" id="width">
                <p>Only numbers allowed for Product Width.</p>
                <div class="invalid-feedback" style="display: block">
                    <?php echo $model->getFirstError('width');?>
                </div>
            </div>
        </div>
        <!--Length-->
        <div class="row mt-3">
            <div class="col-lg-2 col-md-3  col-sm-4">
                <label for="length" class="form-label w-100 fs-4 bg-transparent">Length (CM) </label>
            </div>
            <div class="col-lg-6 col-md-9  col-sm-8">
                <input value="<?php echo ($model->{'length'}) ?? ''; ?>" required placeholder="Enter Furniture Length" type="text" name="length" class="form-control <?= $model->hasError('length') ? 'is-invalid' : ''; ?>" id="length">
                <p>Only numbers allowed for Product Length.</p>
                <div class="invalid-feedback" style="display: block">
                    <?php echo $model->getFirstError('length');?>
                </div>
                <label class="attribute">Please Provide dimensions in HxWxL format.</label>
            </div>
        </div>
        <h4 class="mt-4">"Product Description"</h4>
    </div>
    <!--Book select option-->
    <div id="Book" class="type" style="display: none">
        <div class="row mt-4">
            <div class="col-lg-2 col-md-3  col-sm-4">
                <label for="weight" class="form-label w-100 fs-4 bg-transparent">Weight (KG) </label>
            </div>
            <div class="col-lg-6 col-md-9  col-sm-8">
                <input value="<?php echo ($model->{'weight'}) ?? ''; ?>" required placeholder="Enter Book Weight" type="text" name="weight" class="form-control <?= $model->hasError('weight') ? 'is-invalid' : ''; ?>" id="weight">
                <p>Only numbers allowed for Product Weight.</p>
                <div class="invalid-feedback" style="display: block">
                    <?php echo $model->getFirstError('weight');?>
                </div>
                <label class="attribute">Please Provide weight in KG format.</label>
            </div>
        </div>
        <h4 class="mt-4">"Product Description"</h4>
    </div>
</form>
<script src="frontend/assets/js/AddProduct.js"></script>