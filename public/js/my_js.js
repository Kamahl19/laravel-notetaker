// Confirm deleting
function deleteObject(object, form) {
  var msg;
  
  if (object == 'note') {
    msg = 'Naozaj chcete zmazať túto poznámku?';
  } else {
    msg = 'Naozaj chcete zmazať túto kategóriu?';
  }
  
  BootstrapDialog.show({
    title: 'Zmazať',
    message: msg,
    buttons: [{
      label: 'Zrušiť',
      action: function(dialog) {
        dialog.close();  
      }
    }, {
      label: 'Zmazať',
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
    maxFilesize: 5,
    addRemoveLinks: true,
    dictDefaultMessage: 'Sem presunte súbory, ktoré chcete pridať',
    dictCancelUpload: 'Zrušiť',
    dictCancelUploadConfirmation: 'Naozaj chcete zrušiť nahrávanie súboru?',
    dictRemoveFile: 'Zmazať',
    dictFileTooBig: 'Súbor je príliš veľký. Maximálna veľkost je 5 MB',
    removedfile: function(file) { 
      alert(file);
      /*       
      $.ajax({
        type: 'POST',
        url: $("input[name=route]").val() + '/uploads/',
        data: "id="+ add_your_filename_here,
        dataType: 'html'
      });
      */
      var _ref;
      return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;        
    }
  };
  
  // Simulate click on .dropzone when button clicked
  $(document).on("click", ".add-attachment", function() {         
    $('#upload-form').click();
  });     

	// Display date and time picker
  $(function() {
	  $("#date-picker").datetimepicker({
      timeOnlyTitle: 'Termín',
      timeText: 'Čas',
      hourText: 'Hodina',
      minuteText: 'Minuta',
      currentText: 'Teraz',
      closeText: 'OK',
      changeMonth: true,
			changeYear: true,
			dateFormat: "d.m.yy"
		});
	});            

	// Delete note      
	$(function() {
    $('[data-method]').append(function() {
        return "\n"+
        "<form action='"+$(this).attr('href')+"' method='POST' style='display:none'>\n"+
        "	<input type='hidden' name='_method' value='"+$(this).attr('data-method')+"'>\n"+
        "</form>\n"
    })
    .removeAttr('href')
    .attr('style','cursor:pointer;')
    .attr('onclick','deleteObject($(this).attr("data-object"), $(this).find("form"));');
	});
  
  // Create category
  var catName = '';
  var catForm = $('<div><input id="name" class="form-control" type="text" name="name" placeholder="Názov" autofocus></div>');
  
  $(document).on("click", ".create-category", function() {
    BootstrapDialog.show({
      title: 'Nová kategória',
      message: catForm,
      buttons: [{
        label: 'Zrušiť',
        action: function(dialog) {
          dialog.close();  
        }
      }, {
        label: 'Uložiť',
        cssClass: 'btn-primary',
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
                BootstrapDialog.alert("Kategória s týmto názvom už existuje");
              }
            })
            .error(function(response) {
              BootstrapDialog.alert("Kategória nebola vytvorená: " + response.responseText);
            });
          }
          
          dialog.close();
        }
      }]
    });  
  });     
  
});