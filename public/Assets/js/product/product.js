//update section brands
$('#select_categories').on('click', function () {
    const $this = $(this);
    const title_brand = $this.data('title');
    const desc_brand = $this.data('description');
    const id_brand = $this.data('id-brand');
    const modal = $('#show-edit-brands');
    modal.find('#edit-brand-title').html(title_brand);
    modal.find('input[name=id]').val(id_brand);
    modal.find('input[name=title]').val(title_brand);
    modal.find('textarea[name=description]').val(desc_brand);
});

//show sweet alert update section
$('#select_categories').on('click', function () {
    const $this = $(this);
    const $categories = $this.data('categories');
    const $desc = $this.data('desc');
    $('#edit_product').html($categories);
    $('#edit_product').html($desc);
    const $modal_brand = $(document).find('#show-edit-brands');
    const title_brand = $modal_brand.find("input[name='title']").val();
    const id_brand = $modal_brand.find("input[name='id']").val();
    const description_brand = $modal_brand.find("textarea[name='description']").val();
    console.log(id_brand);
});

$('.btn-show-description').on('click', function () {
    const $this = $(this);
    const $title = $this.data('title');
    const $desc = $this.data('desc');
    $('#show_description #product_title').html($title);
    $('#show_description #product_description').html($desc);
});

$('a.btn-edit-product').on('click', function () {
    const $this = $(this);
    const $modal = $('#edit_product');
    const $title = $this.data('title');
    const $id = $this.data('product-id');
    const $brand = $this.data('brand');
    const $desc = $this.data('description');
    $modal.find('#edit_product_title').html($title);
    $modal.find('input[name=id]').val($id);
    $modal.find('input[name=title]').val($title);
    $modal.find('textarea[name=description]').val($desc);
    $modal.find('select[name=brand]').selectpicker('val', $brand).selectpicker('refresh');
});

$('#submit_update_product').on('click', function () {
    const $modal = $(document).find('#edit_product');
    const id = $modal.find("input[name='id']").val();
    const title = $modal.find("input[name='title']").val();
    const brand_id = $modal.find("select[name='brand']").val();
    const description = $modal.find("textarea[name='description']").val();
    $.ajax({
        dataType: 'json',
        method: 'post',
        data: {
            id: id,
            title: title,
            brand_id: brand_id,
            description: description,
            action: 'update_product',
        },
        success: function (response) {
            Swal.fire({
                title: response.message.title,
                html: response.message.text,
                icon: response.message.type,
                buttonsStyling: false,
                confirmButtonText: "متوجه شدم!",
                customClass: {
                    confirmButton: "btn btn-primary",
                }
            }).then(function (done) {
                if (done.isConfirmed === true) {
                    window.location.reload();
                }
            });
        },
        error: function (response) {
            console.log("Error:", response);
        }
    });
});

$('.btn-show-description').on('click', function () {
    const $this = $(this);
    const $title = $this.data('title');
    const $desc = $this.data('desc');
    $('#show_description #product_title').html($title);
    $('#show_description #product_description').html($desc);
});

// upload picture for product
$(document).on('click', '.btn-upload-picture', function (e) {
    e.preventDefault();
    const $modal = $('#picture_product');
    $modal.find('input[name=product_id]').val($(this).data('id'))
    $modal.modal('show');
});

$('#form_picture_product').on('submit', function (e) {
    e.preventDefault();
    const $data = new FormData(this);

    $data.append('action', 'upload_picture_product');

    $.ajax({
        method: 'POST',
        contentType: false,
        cache: false,
        processData: false,
        data: $data,
        success: function (response) {
            const $response = JSON.parse(response);
            if ($response.status === 200) {
                Swal.fire({
                    title: $response.message.title,
                    html: $response.message.text,
                    icon: $response.message.type,
                    buttonsStyling: false,
                    confirmButtonText: "متوجه شدم!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                }).then(function () {
                    window.location.reload();
                });
            } else {
                Swal.fire({
                    title: $response.message.title,
                    html: $response.message.text,
                    icon: $response.message.type,
                    buttonsStyling: false,
                    confirmButtonText: "متوجه شدم!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
            }
        },
        error: function (response) {
            console.log("Error:", response);
        }
    });
});

(new KTImageInput('picture_product_1'));
(new KTImageInput('picture_product_2'));
(new KTImageInput('picture_product_3'));
(new KTImageInput('picture_product_4'));