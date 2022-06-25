<?php include __DIR__ . "/../../partials/header.php";
include __DIR__ . "/../../partials/aside.php"; ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" style="padding-top: 0px;">
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        <span class="card-icon">
                            <i class="flaticon2-favourite text-primary"></i>
                        </span>
                        <h3 class="card-label">مدیریت کاربران</h3>
                    </div>
                </div>
                <?php $users = App\Models\User::getUsers(); ?>
                <div class="card-body">
                    <table class="table table-bordered table-hover table-checkable" id="datatable_users" style="margin-top: 13px;text-align: center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>نام</th>
                                <th>نام خانوادگی</th>
                                <th>موبایل</th>
                                <th>وضعیت</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $key => $user) { ?>
                                <tr>
                                    <td><?php echo $key + 1 ?></td>
                                    <td><?php echo $user->first_name; ?></td>
                                    <td><?php echo $user->last_name; ?></td>
                                    <td><?php echo $user->mobile; ?></td>
                                    <td><?php echo ($user->status === 'active') ? 'فعال' : 'غیرفعال'; ?></td>
                                    <td nowrap="nowrap">
                                        <div class="dropdown dropdown-inline">
                                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
                                                <i class="la la-cog"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                <ul class="nav nav-hoverable flex-column">
                                                    <li class="nav-item"><a class="nav-link" href="#"><i class="nav-icon la la-edit"></i><span class="nav-text">Edit Details</span></a></li>
                                                    <li class="nav-item"><a class="nav-link" href="#"><i class="nav-icon la la-leaf"></i><span class="nav-text">Update Status</span></a></li>
                                                    <li class="nav-item"><a class="nav-link" href="#"><i class="nav-icon la la-print"></i><span class="nav-text">Print</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Edit details">
                                            <i class="la la-edit"></i>
                                        </a>
                                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete">
                                            <i class="la la-trash"></i>
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
<?php include __DIR__ . "/../../partials/footer.php"; ?>