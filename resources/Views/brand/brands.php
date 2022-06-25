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
                        <h3 class="card-label">افزودن برند جدید</h3>
                    </div>
                </div>
                <div class="card-body">
                    <!--start form insert brand-->
                    <form class="form" action="" method="post">
                        <div class="card-body">
                            <input type="hidden" name="action" value="create_brands">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>عنوان:</label>
                                    <label>
                                        <input type="text" name="title" class="form-control" placeholder="نام برند را وارد کنید..." />
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label>توضیحات:</label>
                                    <label for="category_description"></label><textarea class="form-control" name="description" id="category_description" rows="3"></textarea>
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
                    <!--end form insert brand-->
                </div>
            </div>
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        <span class="card-icon">
                            <i class="flaticon2-favourite text-primary"></i>
                        </span>
                        <h3 class="card-label">مدیریت برند ها</h3>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover table-checkable" id="datatable_brands" style="margin-top: 13px;text-align: center">
                        <thead>
                            <tr>
                                <th>ردیف</th>
                                <th>نام برند</th>
                                <th>توضیحات</th>
                                <th>وضعیت</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $brands = App\Models\Brand::getBrands();
                            if ($brands) {
                                foreach ($brands as $key => $brand) {
                            ?>
                                    <tr>
                                        <td><?php echo $key + 1 ?></td>
                                        <td><?php echo $brand->title; ?></td>
                                        <td><button data-title="<?php echo $brand->title; ?>" data-desc="<?php echo $brand->description; ?>" type="button" class="btn btn-success btn-show-desc-brands" data-toggle="modal" data-target="#show-description-brands">نمایش دادن</button></td>
                                        <td><?php echo $brand->status ?></td>
                                        <td nowrap="nowrap">
                                            <a href="javascript:;" data-id-brand="<?php echo $brand->id ?>" data-title="<?php echo $brand->title; ?>" data-description="<?php echo $brand->description; ?>" data-toggle="modal" data-target="#show-edit-brands" class="show-edit-brands btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                                <span class="svg-icon svg-icon-md svg-icon-primary">
                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Write.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
                                                            <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                        </g>
                                                    </svg>
                                                </span>
                                            </a>
                                            <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                                <span class="svg-icon svg-icon-md svg-icon-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero" />
                                                            <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3" />
                                                        </g>
                                                    </svg>
                                                </span>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!--start Modal show Brands-->
<div class="modal fade" id="show-description-brands" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">توضیحات «<span id="brands-title"></span>»</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body" style="height: 300px;" id="brands-description"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">بستن</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="show-edit-brands" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ویرایش «<span id="edit-brand-title"></span>»</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <!--start form edit brand-->
                <form class="form" action="" method="post">
                    <input type="hidden" name="id">
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>عنوان:</label>
                                <label>
                                    <input type="text" name="title" class="form-control" placeholder="نام برند را وارد کنید..." />
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label>توضیحات:</label>
                                <label for="category_description"></label><textarea class="form-control" name="description" id="category_description" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
                <!--end form edit brand-->
            </div>
            <div class="modal-footer">
                <button id="btn-edit-brand" type="button" class="btn btn-light-success font-weight-bold">ثبت تغییرات</button>
                <button type="button" class="btn btn-light-danger font-weight-bold" data-dismiss="modal">بستن</button>
            </div>
        </div>
    </div>
</div>
<!--End modal Edit Brand-->
<?php include __DIR__ . "/../../partials/footer.php"; ?>