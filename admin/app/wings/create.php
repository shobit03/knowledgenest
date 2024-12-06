<?php require '../../includes/db-config.php';
require '../../includes/helper.php'; ?>
<style>
  .form-check-input {
    accent-color: #007bff;
    width: 20px;
    height: 20px;
  }

  .form-check-label {
    margin-left: 5px;
    font-weight: 500;
    font-size: 14px;
  }
</style>

<div class="modal-header">
  <h3 class="modal-title">Add wings</h3>
  <button type="button" class="btn-close" data-bs-dismiss="modal">
  </button>
</div>
<div class="card-body">
  <div class="form-validation">
    <form class="needs-validation" role="form" id="form-add-wings" action="/admin/app/wings/store" method="POST" enctype="multipart/form-data">
      <div class="row">



        <div class="mb-3 col-md-6">
          <label class="form-label">Name
            <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="name" placeholder="Enter a wings Name.." required>
        </div>

        <!-- Category Dropdown -->
        <div class="mb-3 col-md-6">
          <label class="form-label">Category <span class="text-danger">*</span></label>
          <select class="form-control" name="category" required>
            <option value="" disabled selected>Select a Category</option>
            <?php foreach ($categoryArr as $key => $value) : ?>
              <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <!-- Date Input -->
        <div class="mb-3 col-md-6">
          <label class="form-label">Date <span class="text-danger">*</span></label>
          <input type="date" class="form-control" name="date" placeholder="Select a date..." required>
        </div>


        <div class="mb-3 col-md-6">
          <label class="form-label">Media Type <span class="text-danger">*</span></label><br>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="media_type" id="media_type_link" value="link" required>
            <label class="form-check-label" for="media_type_link">Link</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="media_type" id="media_type_upload" value="upload" required>
            <label class="form-check-label" for="media_type_upload">Upload</label>
          </div>
        </div>


        <div class="mb-3 col-md-12 media-field" id="link-field" style="display:none;">
          <label class="form-label">Link <span class="text-danger">*</span></label>
          <input type="url" name="media_link" id="media_link" class="form-control" placeholder="Enter the link">
        </div>

        <div class="mb-3 col-md-12 media-field" id="upload-field" style="display:none;">
          <label class="form-label">Photo <span class="text-danger">*</span></label>
          <input type="file" name="media_file" id="media_file" class="form-control" accept="image/*" multiple>
        </div>


        <!-- <div class="mb-3 col-md-12 syllabus_file">
          <label class="form-label">Photo </label>
          <input type="file" name="photo" id="photo" class="form-control" onchange="fileValidation('photo')" accept="image/png, image/jpg, image/jpeg, image/svg,image/avif">
        </div> -->

        <!-- <div class="mb-3 col-md-12">
          <label class="form-label">Short Description<span class="text-danger">*</span></label>
          <textarea cols="2" class="form-control" name="description" placeholder="Enter a Short Description.." required></textarea>
        </div> -->

        <div class="mb-3 col-md-12 ">
          <label class="form-label">Content <span class="text-danger">*</span></label>
          <textarea class="ckeditor" cols="80" id="editor" name="editor" rows="10" required></textarea>
          <span id="content-error" style="color:#b91e1e;font-weight: 500;font-size: 12px;"></span>
        </div>

        <div class="mb-3 col-md-6">
          <label class="form-label">Meta Title
          </label>
          <input type="text" class="form-control" name="meta_title" placeholder="Enter a Meta Title..">
        </div>
        <div class="mb-3 col-md-6">
          <label class="form-label">Meta Key
          </label>
          <input type="text" class="form-control" name="meta_key" placeholder="Enter a Meta Key..">
        </div>
        <div class="mb-3 col-md-12">
          <label class="form-label">Meta Description</label>
          <textarea cols="2" class="form-control" name="meta_description" placeholder="Enter a Meta Description.."></textarea>
        </div>


        <!-- Position -->
        <div class="col-md-12">
          <label class="form-label">Order By <span class="text-danger">*</span></label>
          <input type="number" min="0" class="form-control" name="position" placeholder="Enter a Position..." required>
        </div>
      </div>
      <div class=" modal-footer clearfix text-end">
        <div class="col-md-4 m-t-10 sm-m-t-10">
          <button aria-label="" type="submit" class="btn btn-primary btn-cons btn-animated from-left">
            <span>Save</span>
          </button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

        </div>
      </div>
  </div>
  </form>
</div>
</div>


<script>
  $('input[name="media_type"]').on('change', function() {
    if ($(this).val() === 'link') {
      $('#link-field').show();
      $('#upload-field').hide();
    } else {
      $('#upload-field').show();
      $('#link-field').hide();
    }
  });
</script>

<script>
  $(function() {
    $('#form-add-wings').validate({
      errorPlacement: function(error, element) {
        if (element.is("select")) {
          error.insertAfter(element.parent());
        } else {
          error.insertAfter(element);
        }
      }
    });
  })

  $("#form-add-wings").on("submit", function(e) {
    if ($('#form-add-wings').valid()) {
      // $(':input[type="submit"]').prop('disabled', true);

      var editorContent = CKEDITOR.instances.editor.getData();
      if (editorContent == '') {
        $("#content-error").text("This field is required.");
        return false;
      }
      var formData = new FormData(this);
      formData.append('content', editorContent);

      $.ajax({
        url: this.action,
        type: 'post',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(data) {
          if (data.status == 200) {
            $('.modal').modal('hide');
            toastr.success(data.message, 'Success');

            $('#wings-table').DataTable().ajax.reload(null, false);
          } else {
            $(':input[type="submit"]').prop('disabled', false);
            toastr.error(data.message, 'Error');
          }
        }
      });
      e.preventDefault();
    }
  });
</script>

<script>
  CKEDITOR.replace('editor');
</script>