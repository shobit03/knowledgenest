<?php require '../../includes/db-config.php';
require '../../includes/helper.php'; ?>

<div class="modal-header">
  <h5 class="modal-title">Add category</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>
<div class="card-body">
  <div class="form-validation">
    <form class="needs-validation" role="form" id="form-add-stream" action="/admin/app/category/store" method="POST" enctype="multipart/form-data">
      <div class="row">

        <div class="mb-3 col-md-12">
          <label class="form-label">Menu<span class="text-danger">*</span></label>
          <?php $menuArr = getMenuFunc($conn); ?>
          <select name="Menu_ID" id="Menu_ID" class="form-control sumoselect" required>
            <option value="">Select Menu</option>
            <?php foreach ($menuArr as $menu) { ?>
              <option value="<?= $menu['ID'] ?>"><?= $menu['Name'] ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="mb-3 col-md-12">
          <label class="form-label">Name <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="name" placeholder="Enter a category Name.." required>
        </div>

        <div class="mb-3 col-md-12">
          <label class="form-label">Short Name <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="Short_Name" placeholder="Enter a Short Name.." required>
        </div>

        <div class="mb-3 col-md-12">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="have_details" id="have_details" value="1">
            <label class="form-check-label" for="have_details">
              Have Details
            </label>
          </div>
        </div>
        <div class="mb-3 col-md-12 syllabus_file">
          <label class="form-label">Photo </label>
          <input type="file" name="photo" id="photo" class="form-control" onchange="fileValidation('photo')" accept="image/png, image/jpg, image/jpeg, image/svg,image/avif">
          <small class="text-muted">
            Note: Please upload a valid image file (PNG, JPG, JPEG, SVG, or AVIF) with a size less than or equal to 200KB.
          </small>
        </div>

        <div class="mb-3 col-md-12">
          <label class="form-label">Heading Name <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="heading" placeholder="Enter a Heading Name..">
        </div>

        <!-- Short Description -->
        <div class="mb-3 col-md-12">
          <label for="short_description" class="form-label">Short Description <span class="text-danger">*</span></label>
          <textarea id="short_description" name="short_description" class="form-control" rows="5" placeholder="Enter a short description..."></textarea>
        </div>

        <div class="mb-3 col-md-12 ">
          <label class="form-label">Content <span class="text-danger">*</span></label>
          <textarea class="ckeditor" cols="80" id="editor" name="editor" rows="10"></textarea>
          <span id="content-error" style="color:#b91e1e;font-weight: 500;font-size: 12px;"></span>
        </div>


        <div class="mb-3 col-md-12">
          <label class="form-label">Order By <span class="text-danger">*</span></label>
          <input type="number" min="0" class="form-control" name="position" placeholder="Enter a Position.." required>
        </div>
      </div>
      <div class="modal-footer clearfix text-end">
        <div class="col-md-4 m-t-10 sm-m-t-10">
          <button aria-label="" type="submit" class="btn btn-primary btn-cons btn-animated from-left">
            <span>Save</span>
          </button>
        </div>
      </div>
    </form>
  </div>
</div>



<!-- <script>
  $(document).ready(function() {
    $('#form-add-stream').validate({
      rules: {
        name: {
          required: true
        },
        Short_Name: {
          required: true
        },
        position: {
          required: true,
          number: true,
          min: 0
        }
      },
      messages: {
        position: {
          required: "Please enter the position.",
          number: "Please enter a valid number for the position.",
          min: "Position must be at least 0."
        }
      },
      highlight: function(element) {
        $(element).addClass('error');
        $(element).closest('.form-control').addClass('has-error');
      },
      unhighlight: function(element) {
        $(element).removeClass('error');
        $(element).closest('.form-control').removeClass('has-error');
      },
      submitHandler: function(form) {
        var formData = new FormData(form);

        $.ajax({
          url: form.action,
          type: 'POST',
          data: formData,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(data) {
            if (data.status == 200) {
              $('.modal').modal('hide');
              toastr.success(data.message, 'Success');
              $('#category-table').DataTable().ajax.reload(null, false);
            } else {
              $(':input[type="submit"]').prop('disabled', false);
              toastr.error(data.message, 'Error');
            }
          },
          error: function(xhr, textStatus, errorThrown) {
            toastr.error('Error submitting form: ' + errorThrown, 'Error');
          }
        });
        return false;
      }
    });
  });
</script> -->

<!-- <script>
  CKEDITOR.replace('editor');
</script> -->


<script>
  $(document).ready(function() {
    // $('.ckeditor').each(function() {
    //   CKEDITOR.replace($(this).attr('id'));
    // });

    $('#form-add-stream').validate({
      rules: {
        name: {
          required: true
        },
        Short_Name: {
          required: true
        },
        editor: {
          required: true
        },
        position: {
          required: true,
          number: true,
          min: 0
        }
      },
      messages: {
        name: {
          required: "Please enter the category name."
        },
        Short_Name: {
          required: "Please enter the short name."
        },
        editor: {
          required: "Please enter the content."
        },
        position: {
          required: "Please enter the position.",
          number: "Please enter a valid number for the position.",
          min: "Position must be at least 0."
        }
      },
      highlight: function(element) {
        $(element).addClass('error');
        $(element).closest('.form-control').addClass('has-error');
      },
      unhighlight: function(element) {
        $(element).removeClass('error');
        $(element).closest('.form-control').removeClass('has-error');
      },
      submitHandler: function(form) {
        var formData = new FormData(form);

        var content = CKEDITOR.instances['editor'].getData();
        formData.append('content', content);

        $.ajax({
          url: form.action,
          type: 'POST',
          data: formData,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(data) {
            if (data.status == 200) {
              $('.modal').modal('hide');
              toastr.success(data.message, 'Success');
              $('#category-table').DataTable().ajax.reload(null, false);
            } else {
              toastr.error(data.message, 'Error');
            }
          },
          error: function(xhr, textStatus, errorThrown) {
            toastr.error('Error submitting form: ' + errorThrown, 'Error');
          }
        });
        return false;
      }
    });
  });
</script>

<script>
  CKEDITOR.replace('editor');
</script>