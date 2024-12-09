<?php
require '../../includes/db-config.php';
require '../../includes/helper.php';
?>

<div class="modal-header">
  <h5 class="modal-title">Add Specializations</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>
<div class="card-body">
  <div class="form-validation">
    <form class="needs-validation" role="form" id="form-add-specializations" action="/admin/app/specializations/store" method="POST" enctype="multipart/form-data">
      <div class="row">

        
        <div class="mb-3 col-md-6">
          <label class="form-label">Menu<span class="text-danger">*</span></label>
          <?php $menuArr = getMenuFunc($conn); ?>
          <select name="Menu_ID" id="Menu_ID" class="form-control sumoselect" required>
            <option value="">Select Menu</option>
            <?php foreach ($menuArr as $menu) { ?>
              <option value="<?= $menu['ID'] ?>"><?= $menu['Name'] ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="mb-3 col-md-6">
          <label class="form-label">Category<span class="text-danger">*</span></label>
          <select name="Category_ID" id="Category_ID" class="form-control sumoselect" required>
            <option value="">Select Menu First</option>
          </select>
        </div>

        <div class="mb-3 col-md-6">
          <label class="form-label">Sub Category<span class="text-danger">*</span></label>
          <select name="Sub_Category_ID" id="Sub_Category_ID" class="form-control sumoselect" required>
            <option value="">Select Category First</option>
          </select>
        </div>

        <div class="mb-3 col-md-6">
          <label class="form-label">Name <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="name" placeholder="Enter a Specialization Name.." required>
        </div>

        <div class="mb-3 col-md-6">
          <label class="form-label">Short Name <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="Short_Name" placeholder="Enter a Short Name.." required>
        </div>

        <div class="mb-3 col-md-6">
          <label class="form-label">Photo <span class="text-danger">*</span></label>
          <input type="file" class="form-control" name="photo" required>
        </div>

        <div class="mb-3 col-md-6">
          <label class="form-label">Eligibility <span class="text-danger">*</span></label>
          <!-- <textarea class="form-control" name="eligibility" rows="5" required></textarea> -->
          <input type="text" class="form-control" name="eligibility" placeholder="Enter eligibility.." required>

        </div>

        <div class="mb-3 col-md-6">
          <label class="form-label">Duration  <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="duration" placeholder="Enter Duration.." required>
        </div>

        <div class="mb-3 col-md-12">
          <label class="form-label">Short Description<span class="text-danger">*</span></label>
          <textarea cols="2" rows="10" class="form-control" name="description" placeholder="Enter a Short Description.." required ></textarea>
        </div>

        <div class="mb-3 col-md-12">
          <label class="form-label">Content <span class="text-danger">*</span></label>
          <textarea class="ckeditor" cols="80" id="editor" name="content" rows="10"></textarea>
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

<script>
  $(document).ready(function() {
  
    $('#Menu_ID').change(function() {
      var menuID = $(this).val();
      if (menuID) {
        $.ajax({
          type: 'POST',
          url: '/admin/app/sub_category/get_menu',
          data: 'menu_id=' + menuID,
          success: function(html) {
            $('#Category_ID').html(html);
          }
        });
      } else {
        $('#Category_ID').html('<option value="">Select Menu First</option>');
      }
    });


    $('#Category_ID').change(function() {
      var categoryID = $(this).val();
      if (categoryID) {
        $.ajax({
          type: 'POST',
          url: '/admin/app/specializations/get_course',
          data: 'category_id=' + categoryID,
          success: function(html) {
            $('#Sub_Category_ID').html(html);
          }
        });
      } else {
        $('#Sub_Category_ID').html('<option value="">Select Category First</option>');
      }
    });

    // $('#Program_ID').change(function() {
    //   var programID = $(this).val();
    //   if (programID) {
    //     $.ajax({
    //       type: 'POST',
    //       url: '/admin/app/specializations/get_course',
    //       data: 'program_id=' + programID,
    //       success: function(html) {
    //         $('#Course_ID').html(html);
    //       }
    //     });
    //   } else {
    //     $('#Course_ID').html('<option value="">Select Program First</option>');
    //   }
    // });

    $('.ckeditor').each(function() {
      CKEDITOR.replace($(this).attr('id'));
    });

    $('#form-add-specializations').validate({
      rules: {
        name: {
          required: true
        },
        Short_Name: {
          required: true
        },
        content: {
          required: true
        },
        position: {
          required: true,
          number: true,
          min: 0
        },
        photo: {
          required: true
        },
        eligibility: {
          required: true
        },
        duration: {
          required: true,

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
        formData.append('content', CKEDITOR.instances['editor'].getData());

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
              $('#specializations-table').DataTable().ajax.reload(null, false);
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
</script>