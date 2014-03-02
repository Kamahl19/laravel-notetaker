// Confirm deleting
function deleteObject(object, form) {
  var msg;
  
  if (object == 'note') {
    msg = trans.confirm_delete_note;
  } else {
    msg = trans.confirm_delete_category;
  }
  
  BootstrapDialog.show({
    title: trans.del,
    message: msg,
    buttons: [{
      label: trans.cancel,
      action: function(dialog) {
        dialog.close();  
      }
    }, {
      label: trans.del,
      cssClass: 'btn-primary',
      action: function(dialog) {
        dialog.close();
        form.submit();
      }
    }]
  });
}            

$(document).ready(function() {
  
  // DropzoneJS options
  Dropzone.options.uploadForm = {
    maxFilesize: 10,
    addRemoveLinks: true,
    dictDefaultMessage: trans.upload_default_message,
    dictCancelUpload: trans.cancel,
    dictCancelUploadConfirmation: trans.confirm_cancel_upload,
    dictRemoveFile: trans.del,
    dictFileTooBig: trans.upload_file_too_big,
    // Show existing attachments
    init: function() {               
      // append hidden input so we can update note_id in attachments table when we insert new note
      this.on("success", function(file, response) {
        file.serverId = response.id;
        $('#create-note').append('<input type="hidden" name="attachment_ids[]" value="'+response.id+'" />');
      });
      
      // delete file and DB entry
      this.on("removedfile", function(file) {
        $.ajax({
          type: "DELETE",
          url: $("input[name=route]").val() + '/attachments/' + file.serverId
        })
        .success(function(data) {
          if (data.status == 1) {
            $("#create-note input[value=" + file.serverId + "]").remove();
          }
        });
      });
      
      // 
      this.on("addedfile", function(file) {
        var downloadButton = Dropzone.createElement("<a style='float: right;'>" + trans.download + "</a>");
        
        downloadButton.addEventListener("click", function(e) {
          e.preventDefault();
          e.stopPropagation();
          
          window.open($("input[name=route]").val() + "/attachments/download/" + file.serverId, "_blank");
        });
        
        file.previewElement.appendChild(downloadButton);
      });
      
      // display all attachments for this note
      var thisDropzone = this;
      var current_url = window.location.pathname.split('/');  
      var note_id = current_url[current_url.length-2];
      
      // if we are editing note
      if ( !isNaN(note_id) ) {
        current_url.pop(); current_url.pop(); current_url.pop();            
        var root_url = current_url.join('/');
        var getUrl = $("input[name=route]").val() + '/attachments/' + note_id;
          
        $.get(getUrl, function(data) {
          $.each(data, function(key, value) {        
            var attachment = { name: value.filename, size: value.filesize, serverId: value.id };
            thisDropzone.emit("addedfile", attachment);
            
            // if image, display thumbnail
            var ext = value.filename.split('.').pop();
            if (ext == 'jpg' || ext == 'jpeg' || ext == 'png' || ext == 'gif') {
              thisDropzone.emit("thumbnail", attachment, root_url + "/uploads/"+value.folder+"/"+value.filename);
            }
          });   
        });     
      }
    }
  };
  
  // Simulate click on .dropzone when button clicked
  $(document).on("click", ".add-attachment", function() {         
    $('#upload-form').click();
  });     
  
  // Open note URL
  $(document).on("click", ".open-url", function() {   
    var url = $("input[name=url]").val();
    
    if (url.search(/(ftp|http|https):\/\//) == -1) {
      url = 'http://' + url;
    }
        
    window.open(url, "_blank");
  });

	// Display date and time picker
  $(function() {
	  $("#date-picker").datetimepicker({
      timeOnlyTitle: trans.deadline,
      timeText: trans.time,
      hourText: trans.hour,
      minuteText: trans.minute,
      currentText: trans.now,
      closeText: trans.ok,
      changeMonth: true,
			changeYear: true,
			dateFormat: trans.date_format
		});
	});            

	// Delete note      
	$(function() {
    $('[data-method]').append(function() {
        return "\n"+
        "<form action='"+$(this).attr('href')+"' method='POST' style='display: none;'>\n"+
        "	<input type='hidden' name='_method' value='"+$(this).attr('data-method')+"'>\n"+
        "</form>\n"
    })
    .removeAttr('href')
    .attr('style','cursor: pointer;')
    .attr('onclick','deleteObject($(this).attr("data-object"), $(this).find("form"));');
	});
  
  // Create category
  var catName = '';
  var catForm = $('<div><input id="name" class="form-control" type="text" name="name" placeholder="' + trans.title + '"></div>');
  
  $(document).on("click", ".create-category", function() {
    BootstrapDialog.show({
      title: trans.new_category,
      message: catForm,   
      buttons: [{
        label: trans.cancel,
        cssClass: 'btn-default btn-sm',
        action: function(dialog) {
          dialog.close();  
        }
      }, {
        label: trans.save,
        cssClass: 'btn-primary btn-sm',
        action: function(dialog) {
          catName = $("#name").val();

          if (catName.length != 0 && catName != '') {
            $.ajax({
              type: "POST",
              url: $("input[name=route]").val() + '/categories',
              data: {
                name: catName
              }
            })
            .success(function(data) {
              if (data.status == 1) {
                $('#category').append($('<option>', {
                  value: data.msg,
                  text: catName
                }));
                
                $('#category').val(data.msg);
              } else {
                BootstrapDialog.alert(trans.category_exists_already);
              }
            })
            .error(function(response) {
              BootstrapDialog.alert(trans.create_category_error + ": " + response.responseText);
            });
          }
          
          dialog.close();
        }
      }]
    });  
  });
  
});