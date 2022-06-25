$('.btn-show-desc-brands').on('click', function () {
    const thiscmp = $(this);
    const title = thiscmp.data('title');
    const desc = thiscmp.data('desc');
    $('#show-description-brands #brands-title').html(title);
    $('#show-description-brands #brands-description').html(desc);
});

$('.btn-show-desc-brands').on('click', function () {
    const $this = $(this);
    const title = $this.data('title');
    const desc = $this.data('desc');
    $('#show-description-brands #brands-title').html(title);
    $('#show-description-brands #brands-description').html(desc);
});

//update section brands
$('a.show-edit-brands').on('click', function () {
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
$('#btn-edit-brand').on('click', function () {
    const $modal_brand = $(document).find('#show-edit-brands');
    const title_brand = $modal_brand.find("input[name='title']").val();
    const id_brand = $modal_brand.find("input[name='id']").val();
    const description_brand = $modal_brand.find("textarea[name='description']").val();
    console.log(id_brand)
    $.ajax({
        url: '/requests/brands.php',
        dataType: 'json',
        method: 'post',
        data: {
            id_brand: id_brand,
            title_brand: title_brand,
            description_brand: description_brand,
            action: 'edit-brand',
        },
        success: function (response) {
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
                }).then(function (done) {
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
                        confirmButton: "btn btn-danger"
                    }
                });
            }
        },
        error: function (response) {
            console.log("Error:", response);
        }
    });
});
