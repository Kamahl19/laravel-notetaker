// Confirm deleting
function delete_object(object, form) {
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
    .attr('onclick','delete_object($(this).attr("data-object"), $(this).find("form"));');
	});
  
  // Create category
  var name = '';
  var cat_form = $('<div><input id="name" class="form-control" type="text" name="name" placeholder="Názov" autofocus></div>');
  
  $(document).on("click", ".create-category", function() {
    BootstrapDialog.show({
      title: 'Nová kategória',
      message: cat_form,
      buttons: [{
        label: 'Zrušiť',
        action: function(dialog) {
          dialog.close();  
        }
      }, {
        label: 'Uložiť',
        cssClass: 'btn-primary',
        action: function(dialog) {
          name = $("#name").val();

          if (name.length != 0 && name != '') {
            $.ajax({
              type: "POST",
              url: $("input[name=route]").val(),
              data: {
                name: name
              }
            })
            .success(function(data) {
              if (data.status == 1) {
                $('#category').append($('<option>', {
                  value: data.msg,
                  text: name
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