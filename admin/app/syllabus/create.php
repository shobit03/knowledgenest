<?php require '../../includes/db-config.php';
require '../../includes/helper.php'; ?>
<div class="modal-header">
  <h5 class="modal-title">Add Subject</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal">
  </button>
</div>
<div class="card-body">
  <div class="form-validation">
    <form class="needs-validation" role="form" id="form-add-syllabus" action="/admin/app/syllabus/store" method="POST" enctype="multipart/form-data">
      <div class="row">
        <div class="mb-3 col-md-6">
          <label class="form-label">Specialization<span class="text-danger">*</span></label>
          <?php $programArr = getSpecializationFunc($conn); ?>
          <select name="sub_course" id="sub_course" class="form-control" onchange="getSubjects(this.value)" required>
            <option value="">Select Specialization</option>
            <?php foreach ($programArr as $program) {  ?>
              <option value="<?= $program['ID'] ?>"><?= $program['Name'] ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="mb-3 col-md-6">
          <label class="form-label">Subject<span class="text-danger">*</span></label>
          <select name="subject_type" id="subject_type" class="form-control" required>
          </select>
        </div>

        <div class="mb-3 col-md-12 ">
        <label class="form-label">Choose Syllabus Type <span class="text-danger">*</span></label>
        </div>
        <div class="mb-3 col-md-4">
          <div class="form-check mb-2">
            <input class="form-check-input" type="radio" name="syllabus_type"  id="uploadbox" value="0" onchange="show_uploadbox()">
            <label class="form-check-label" for="upload_syllabus">Upload Syllabus </label>
          </div>
        </div>
        <div class="mb-3 col-md-4">
          <div class="form-check mb-4">
            <input class="form-check-input" type="radio" name="syllabus_type" id="ckeditor" value="1" onchange="show_ckeditor()">
            <label class="form-check-label" for="add_syllabus">Add Syllabus</label>
          </div>
        </div>
        <div class="row">
          <div class="mb-3 col-md-12 syllabus_file">
            <label class="form-label">Upload Syllabus <span class="text-danger">*</span></label>
            <input type="file" name="syllabus_file[]" id="syllabus_file" class="form-control" required>
          </div>
        </div>
        <div class="row">
          <div class="mb-3 col-md-12 syllabus_content">
            <label class="form-label">Add Syllabus <span class="text-danger">*</span></label>
           <textarea class="ckeditor" cols="80" id="editor" name="editor" rows="10"></textarea>
          </div>
        </div>
      </div>
      <div class=" modal-footer clearfix text-end">
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
    $('.syllabus_file').hide();
    $('.syllabus_content').hide();
  });

  function show_uploadbox() {
    if ($('#uploadbox').is(":checked")) {
      $('.syllabus_file').show();
      $('.syllabus_content').hide();
    } else {
      $('.syllabus_file').hide();
      $('.syllabus_content').hide();
    }
  }

  function show_ckeditor() {
    if ($('#ckeditor').is(":checked")) {
      $('.syllabus_content').show();
      $('.syllabus_file').hide();
    } else {
      $('.syllabus_file').hide();
      $('.syllabus_content').hide();
    }
  }
</script>
<script>
  $(function() {
    $('#form-add-syllabus').validate({
      rules: {
        name: {
          required: true
        },
        university_id: {
          required: true
        }
      },
      highlight: function(element) {
        $(element).addClass('error');
        $(element).closest('.form-control').addClass('has-error');
      },
      unhighlight: function(element) {
        $(element).removeClass('error');
        $(element).closest('.form-control').removeClass('has-error');
      }
    });
  })

  $("#form-add-syllabus").on("submit", function(e) {
    if ($('#form-add-syllabus').valid()) {
      $(':input[type="submit"]').prop('disabled', true);
      var editorContent = CKEDITOR.instances.editor.getData();
      var syllabus_type = document.getElementsByName('syllabus_type');
      var isAnyRadioButtonSelected = false;
      for (var i = 0; i < syllabus_type.length; i++) {
            if (syllabus_type[i].checked) {
                isAnyRadioButtonSelected = true;
                break;
            }
        }
        if (!isAnyRadioButtonSelected) {
            alert('Please select Syllabus Type.');
            return false;
        }

      var formData = new FormData(this);
      formData.append('syllabus_content', editorContent);
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

            $('#syllabus-table').DataTable().ajax.reload(null, false);
          } else {
            $(':input[type="submit"]').prop('disabled', false);
            toastr.error(data.message, 'Error');
          }
        }
      });
      e.preventDefault();
    }
  });

  function getSubjects(id) {
    $.ajax({
      url: '/admin/app/syllabus/all-subjects?id=' + id,
      type: 'GET',
      success: function(data) {
        $("#subject_type").html(data);
      }
    })
  }
</script>

<script>
  CKEDITOR.replace('editor');
</script>