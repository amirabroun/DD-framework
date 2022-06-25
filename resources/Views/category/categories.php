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
                        <h3 class="card-label">افزودن دسته بندی</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form class="form" action="" method="post">
                        <div class="card-body">
                            <input type="hidden" name="action" value="create_category">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>عنوان:</label>
                                    <input type="text" name="title" class="form-control" placeholder="عنوان دسته بندی را وارد کنید..." />
                                </div>
                                <?php $category_parents = App\Models\Category::getCategoryParents(); ?>
                                <div <?php echo (!$category_parents) ? 'hidden' : null ?> class="col-lg-6">
                                    <label>دسته والد:</label>
                                    <select name="parent" title="دسته والد" class="form-control selectpicker" data-size="7" data-live-search="true">
                                        <?php
                                        if ($category_parents) {
                                            foreach ($category_parents as $category) { ?>
                                                <option value="<?php echo $category->id ?>"><?php echo $category->title ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <span class="form-text text-muted">دسته بندی والد را انتخاب نمایید.</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label>توضیحات:</label>
                                    <textarea class="form-control" name="description" id="category_description" rows="3"></textarea>
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
                        <h3 class="card-label">مدیریت دسته بندی ها</h3>
                    </div>
                </div>
                <?php $categories = App\Models\Category::getCategories(); ?>
                <div class="card-body">
                    <table class="table table-bordered table-hover table-checkable" id="datatable_categories" style="margin-top: 13px;text-align: center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>عنوان</th>
                                <th>توضیحات</th>
                                <th>وضعیت</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($categories as $key => $category) { ?>
                                <tr>
                                    <td><?php echo $key + 1 ?></td>
                                    <td><?php echo $category->title; ?></td>
                                    <td><button data-title="<?php echo $category->title; ?>" data-desc="<?php echo $category->description; ?>" type="button" data-toggle="modal" data-target="#show_description" class="btn btn-info btn-show-desc">نمایش توضیحات</button></td>
                                    <td><?php echo $category->status; ?></td>
                                    <td nowrap="nowrap">
                                        <a data-title="<?php echo $category->title; ?>" data-description="<?php echo $category->description; ?>" data-parent-cat="<?php echo $category->parent_id; ?>" data-cat-id="<?php echo $category->id; ?>" href="javascript:;" data-toggle="modal" data-target="#edit_category" class="btn btn-icon btn-light btn-hover-primary btn-sm btn-edit-category">
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
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="show_description" tabindex="-1" role="dialog" aria-labelledby="show_descriptionLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="show_descriptionLabel">نمایش توضیحات «<span id="category_title"></span>»</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body" id="category_desc"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">بستن</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_category" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ویرایش «<span id="edit_category_title"></span>»</h5>
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
                            <input type="text" name="title" class="form-control" placeholder="عنوان دسته بندی را وارد کنید..." />
                        </div>
                        <?php $category_parents = App\Models\Category::getCategoryParents(); ?>
                        <div <?php echo (!$category_parents) ? 'hidden' : null ?> class="col-lg-6">
                            <label>دسته والد:</label>
                            <select name="parent" title="دسته والد" class="form-control selectpicker" data-size="7" data-live-search="true">
                                <?php
                                if ($category_parents) {
                                    foreach ($category_parents as $category) {
                                ?>
                                        <option value="<?php echo $category->id ?>"><?php echo $category->title ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                            <span class="form-text text-muted">دسته بندی والد را انتخاب نمایید.</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>توضیحات:</label>
                            <textarea class="form-control" name="description" id="category_description" rows="3"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="submit_update_category" type="button" class="btn btn-light-success font-weight-bold">ثبت تغییرات</button>
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">بستن</button>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . "/../../partials/footer.php"; ?>