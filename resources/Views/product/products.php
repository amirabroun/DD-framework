<?php include __DIR__ . "/../../partials/header.php";
include __DIR__ . "/../../partials/aside.php"; ?>

<div class="content d-flex flex-column flex-column-fluid" id="kt_content" style="padding-top: 0px;">
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="card card-custom mb-3">
                <div class="card-header">
                    <div class="card-title">
                        <span class="card-icon">
                            <i class="flaticon2-favourite text-primary"></i>
                        </span>
                        <h3 class="card-label">افزودن محصول</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form class="form" action="" method="post">
                        <div class="card-body">
                            <input type="hidden" name="action" value="create_product">
                            <div class="form-group row">
                                <div class="col-lg-6 mb-4">
                                    <label>عنوان:</label>
                                    <input type="text" name="title" class="form-control" placeholder="عنوان محصول را وارد کنید...">
                                </div>
                                <?php $categories = App\Models\Category::getCategories(); ?>
                                <div <?php echo (!$categories) ? 'hidden' : null ?> class="col-lg-6">
                                    <label>دسته بندی:</label>
                                    <select multiple name="category[]" title="دسته بندی را انتخاب کنید..." class="form-control selectpicker" data-size="7" data-live-search="true">
                                        <?php
                                        if ($categories) {
                                            foreach ($categories as $category) { ?>
                                                <option value="<?php echo $category->id ?>"><?php echo $category->title ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <span class="form-text text-muted">برند محصول را انتخاب نمایید </span>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label>قیمت:</label>
                                    <input type="text" name="price" class="form-control" placeholder="اعداد را لاتین وارد کنید...">
                                </div>
                                <div class="col-lg-6">
                                    <label>با تخفیف:</label>
                                    <input type="text" name="price_discounted" class="form-control" placeholder="اعداد را لاتین وارد کنید...">
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <label>تعداد:</label>
                                    <input type="number" name="stock" class="form-control" value="1" placeholder="اعداد را لاتین وارد کنید...">
                                </div>
                                <?php $brands = App\Models\Brand::getBrands(); ?>
                                <div <?php echo (!$brands) ? 'hidden' : null ?> class="col-lg-6">
                                    <label>برند:</label>
                                    <select name="brand" title="برند" class="form-control selectpicker" data-size="7" data-live-search="true">
                                        <?php
                                        if ($brands) {
                                            foreach ($brands as $brand) { ?>
                                                <option value="<?php echo $brand->id ?>"><?php echo $brand->title ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <span class="form-text text-muted">برند محصول را انتخاب نمایید </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label>توضیحات:</label>
                                    <textarea class="form-control" name="description" id="product_description" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-6">
                                    <button type="submit" class="btn btn-primary mr-2">ثبت</button>
                                    <button type="reset" class="btn btn-secondary">خالی کردن فرم</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card card-custom mb-3">
                <div class="card-header">
                    <div class="card-title">
                        <span class="card-icon">
                            <i class="flaticon2-favourite text-primary"></i>
                        </span>
                        <h3 class="card-label">نمایش محصولات</h3>
                    </div>
                </div>
                <?php $products = App\Models\Product::getProducts(); ?>
                <div class="card-body">
                    <table class="table table-bordered table-hover table-checkable" id="datatable_products" style="margin-top: 13px;text-align: center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>نام محصول</th>
                                <th>قیمت محصول</th>
                                <th>قیمت تخفیف خورده</th>
                                <th>نام برند</th>
                                <th>توضیحات</th>
                                <th>وضعیت</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($products) {
                                foreach ($products as $key => $product) { ?>
                                    <tr>
                                        <td><?php echo $key + 1 ?></td>
                                        <td><?php echo $product->title; ?></td>
                                        <td><?php echo $product->price; ?></td>
                                        <td><?php echo $product->price_discounted; ?></td>
                                        <td><?php echo $product->brand_title; ?></td>
                                        <td>
                                            <button type="button" data-title="<?php echo $product->title; ?>" data-desc="<?php echo $product->description; ?>" data-toggle="modal" data-target="#show_description" class="btn btn-success btn-show-description">نمایش توضیحات</button>
                                        </td>
                                        <td><?php echo $product->status; ?></td>
                                        <td nowrap="nowrap">
                                            <a href="javascript:;" data-images="" data-toggle="tooltip" data-id="<?php echo $product->id; ?>" title="آپلود تصاویر" data-theme="dark" class="btn btn-icon btn-light btn-hover-warning btn-sm mx-3 btn-upload-picture">
                                                <span class="svg-icon svg-icon-warning svg-icon-2x">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <polygon points="0 0 24 0 24 24 0 24" />
                                                            <path d="M6,5 L18,5 C19.6568542,5 21,6.34314575 21,8 L21,17 C21,18.6568542 19.6568542,20 18,20 L6,20 C4.34314575,20 3,18.6568542 3,17 L3,8 C3,6.34314575 4.34314575,5 6,5 Z M5,17 L14,17 L9.5,11 L5,17 Z M16,14 C17.6568542,14 19,12.6568542 19,11 C19,9.34314575 17.6568542,8 16,8 C14.3431458,8 13,9.34314575 13,11 C13,12.6568542 14.3431458,14 16,14 Z" fill="#000000" />
                                                        </g>
                                                    </svg>
                                                </span>
                                            </a>

                                            <a href="<?php echo productLink($product->id) ?>" class="btn btn-icon btn-light btn-hover-primary btn-sm btn-edit-product">
                                                <span class="svg-icon svg-icon-md svg-icon-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
                                                            <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                        </g>
                                                    </svg>
                                                </span>
                                            </a>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="show_description" tabindex="-1" role="dialog" aria-labelledby="show_description" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="show_description">نمایش توضیحات « <span id="product_title"></span> » </h5>
            </div>
            <div class="modal-body" id="product_description"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">بستن</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="picture_product" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تصاویر «<span id="edit_category_title"></span>»</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" action="" method="post" id="form_picture_product">
                    <input type="hidden" name="product_id">
                    <div class="image-input image-input-outline mr-6" id="picture_product_1">
                        <div class="image-input-wrapper" style="background-image: url(assets/media/users/blank.png)"></div>

                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                            <i class="fa fa-pen icon-sm text-muted"></i>
                            <input type="file" name="picture_product_file[]" accept=".png, .jpg, .jpeg" />
                            <input type="hidden" name="profile_avatar_remove" />
                        </label>

                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                        </span>
                    </div>
                    <div class="image-input image-input-outline mr-6" id="picture_product_2">
                        <div class="image-input-wrapper" style="background-image: url(assets/media/users/blank.png)"></div>

                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                            <i class="fa fa-pen icon-sm text-muted"></i>
                            <input type="file" name="picture_product_file[]" accept=".png, .jpg, .jpeg" />
                            <input type="hidden" name="profile_avatar_remove" />
                        </label>

                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                        </span>
                    </div>
                    <div class="image-input image-input-outline mr-6" id="picture_product_3">
                        <div class="image-input-wrapper" style="background-image: url(assets/media/users/blank.png)"></div>

                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                            <i class="fa fa-pen icon-sm text-muted"></i>
                            <input type="file" name="picture_product_file[]" accept=".png, .jpg, .jpeg" />
                            <input type="hidden" name="profile_avatar_remove" />
                        </label>

                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                        </span>
                    </div>
                    <div class="image-input image-input-outline mr-6" id="picture_product_4">
                        <div class="image-input-wrapper" style="background-image: url(assets/media/users/blank.png)"></div>

                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                            <i class="fa fa-pen icon-sm text-muted"></i>
                            <input type="file" name="picture_product_file[]" accept=".png, .jpg, .jpeg" />
                            <input type="hidden" name="profile_avatar_remove" />
                        </label>

                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                        </span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="form_picture_product" class="btn btn-light-success font-weight-bold">ثبت تغییرات</button>
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">بستن</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="edit_product" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ویرایش «<span id="edit_product_title"></span>»</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" action="" method="post">
                    <input type="hidden" name="id">
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label>عنوان:</label>
                            <input type="text" name="title" class="form-control" placeholder="عنوان محصول را وارد کنید..." />
                        </div>
                        <?php $brands = App\Models\Brand::getBrands() ?>
                        <div <?php echo (!$brands) ? 'hidden' : null ?> class="col-lg-6">
                            <label>انتخاب برند</label>
                            <select name="brand" title="برند" class="form-control selectpicker" data-size="7" data-live-search="true">
                                <?php
                                if ($brands) {
                                    foreach ($brands as $brand) {
                                ?>
                                        <option value="<?php echo $brand->id ?>"><?php echo $brand->title ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                            <span class="form-text text-muted">برند را انتخاب نمایید.</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>توضیحات:</label>
                            <textarea class="form-control" name="description" id="product_description" rows="3"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="submit_update_product" type="button" class="btn btn-light-success font-weight-bold">ثبت تغییرات</button>
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">بستن</button>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . "/../../partials/footer.php"; ?>