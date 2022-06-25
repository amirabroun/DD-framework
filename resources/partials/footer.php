<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
    <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
        <div class="text-dark order-2 order-md-1">
            <span class="text-muted font-weight-bold mr-2">2022©</span>
            <a href="#" target="_blank" class="text-dark-75 text-hover-primary">Didishop</a>
        </div>
        <div class="nav nav-dark">
            <a href="#" target="_blank" class="nav-link pl-0 pr-5">درباره ما</a>
            <a href="#" target="_blank" class="nav-link pl-0 pr-5">ارتباط با ما</a>
            <a href="#" target="_blank" class="nav-link pl-0 pr-0">تماس با ما</a>
        </div>
    </div>
</div>
</div>
</div>
</div>

<div id="kt_scrolltop" class="scrolltop">
    <span class="svg-icon">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <polygon points="0 0 24 0 24 24 0 24" />
                <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
                <path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
            </g>
        </svg>
    </span>
</div>

<script>
    var KTAppSettings = {
        "breakpoints": {
            "sm": 576,
            "md": 768,
            "lg": 992,
            "xl": 1200,
            "xxl": 1400
        },
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#3699FF",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#E4E6EF",
                    "dark": "#181C32"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#E1F0FF",
                    "secondary": "#EBEDF3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#3F4254",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#EBEDF3",
                "gray-300": "#E4E6EF",
                "gray-400": "#D1D3E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#7E8299",
                "gray-700": "#5E6278",
                "gray-800": "#3F4254",
                "gray-900": "#181C32"
            }
        },
        "font-family": "Poppins"
    };
</script>
<script src="<?php echo plugins('/global/plugins.bundle.js'); ?>"></script>

<script src="<?php echo plugins('/custom/prismjs/prismjs.bundle.js'); ?>"></script>
<script src="<?php echo plugins('/custom/datatables/datatables.bundle.js'); ?>"></script>
<script src="<?php echo plugins('/custom/fullcalendar/fullcalendar.bundle.js'); ?>"></script>

<script src="<?php echo jsFiles('/app/widgets.js'); ?>"></script>

<script src="<?php echo jsFiles('/app/app.js'); ?>"></script>
<script src="<?php echo jsFiles('/app/config.datatable.js'); ?>"></script>
<script src="<?php echo jsFiles('/app/scripts.bundle.js'); ?>"></script>

<script src="<?php echo jsFiles('/brand/brand.js'); ?>"></script>
<script src="<?php echo jsFiles('/category/category.js'); ?>"></script>
<script src="<?php echo jsFiles('/product/product.js'); ?>"></script>
<script>
    $.ajax({
        success: function(response) {
            if (response.status === 200) {
                Swal.fire({
                    title: response.message.title,
                    html: response.message.text,
                    icon: response.message.type,
                    buttonsStyling: false,
                    confirmButtonText: "متوجه شدم!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                }).then(function(done) {
                    if (done.isConfirmed === true) {
                        window.location.reload();
                    }
                });
            } else {
                Swal.fire({
                    title: response.message.title,
                    html: response.message.text,
                    icon: response.message.type,
                    buttonsStyling: false,
                    confirmButtonText: "متوجه شدم!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
            }
        }
    });
</script>
</body>

</html>