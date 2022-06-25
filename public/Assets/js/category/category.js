$('.btn-show-desc').on('click', function () {
    const $this = $(this);
    const $title = $this.data('title');
    const $desc = $this.data('desc');
    $('#show_description #category_title').html($title);
    $('#show_description #category_desc').html($desc);
});

$('a.btn-edit-category').on('click', function () {
    const $this = $(this);
    const $modal = $('#edit_category');
    const $title = $this.data('title');
    const $desc = $this.data('description');
    const $parent_cat = $this.data('parent-cat');
    const $cat_id = $this.data('cat-id');
    $modal.find('#edit_category_title').html($title);
    $modal.find('input[name=title]').val($title);
    $modal.find('input[name=id]').val($cat_id);
    $modal.find('textarea[name=description]').val($title);
    $modal.find('select[name=parent]').selectpicker('val', $parent_cat).selectpicker('refresh');
});

$('#submit_update_category').on('click', function () {
    const $modal = $(document).find('#edit_category');
    const cat_id = $modal.find("input[name='id']").val();
    const title = $modal.find("input[name='title']").val();
    const parent = $modal.find("select[name='parent']").val();
    const description = $modal.find("textarea[name='description']").val();
    $.ajax({
        url: '/requests/category.php',
        dataType: 'json',
        method: 'post',
        data: {
            id: cat_id,
            title: title,
            parent: parent,
            description: description,
            action: 'update_category',
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