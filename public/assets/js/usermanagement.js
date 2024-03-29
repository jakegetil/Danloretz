$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });



$('#adduser').on('click','#adduser', function(){
    
    $.ajax({
        type: 'POST',
        url: 'user-management/add',
        cache: false,
        data: $('#formadduser').serialize(),
        dataType:'json',
        success: function(response){
            if(response.Error == 1){
                Swal.fire(
                  'Error!',
                   response.message,
                  'error'
                )
              }
              else if(response.Error == 0){
                $("#name").val("");
                $("#email").val("");
                $("#pass1").val("");
                $("#pass2").val("");
                $("#role").val("");
                $("#store").val("");

                Swal.fire(
                  'Saved!',
                   response.message,
                  'success'
                )
                $("#adduser").on("hidden.bs.modal", function(e){
                  window.location.reload();
                 })
              }
        }
    });
})

$('#edituser').on('click','#edituser', function(){

  var name = $(this).closest('tr').find('#name').val()
    $.ajax({
        type: 'POST',
        url: 'user-management/edit',
        cache: false,
        data: $('#formedituser').serialize(),
        dataType:'json',
        success: function(response){
            if(response.Error == 1){
                Swal.fire(
                  'Error!',
                   response.message,
                  'error'
                )
              }
              else if(response.Error == 0){
                Swal.fire(
                  'Saved!',
                   response.message,
                  'success'
                )
                $("#edituser").on("hidden.bs.modal", function(e){
                  window.location.reload();
                 })
              }
        }
    });

})

$(document).on('click','#edit', function(){
    var id = $(this).closest('tr').find('#id').val()
    
    $.ajax({
        url: 'user-management/detail',
        method: 'GET',
        data: { id:id},
        success: function(response) {
            $('#formedituser').find('input[name="id"]').val(response.eid)
            $('#formedituser').find('input[name="efirstname"]').val(response.firstname)
            $('#formedituser').find('input[name="elastname"]').val(response.lastname)
            $('#formedituser').find('input[name="eemail"]').val(response.email)
            $('#formedituser').find('select[name="erole"]').val(response.role)
            $('#formedituser').find('select[name="estore"]').val(response.store)
            
            var eroleSelect = document.querySelector('#erole');
            var estoreSelect = document.querySelector('#estore');
            if (eroleSelect.value == '1') {
              estoreSelect.disabled = true;
              estoreSelect.value = "";
            } else {
                estoreSelect.disabled = false;
            }
        }
    });
    

})


$(document).on('click','#delete', function(){

  var id = $(this).closest('tr').find('#id').val()
  var name = $(this).closest('tr').find('#name').val()

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: 'user-management/delete',
                cache: false,
                data: {id:id, name:name},
                dataType:'json',
                success: function(){
                    Swal.fire({
                        title: 'Deleted!',
                        text: "User has been deleted",
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                      }).then(() => {
                            window.location.reload();
                      })
                }
            });
          
        }
      })
})




var roleSelect = document.querySelector('#role');
var storeSelect = document.querySelector('#store');
var eroleSelect = document.querySelector('#erole');
var estoreSelect = document.querySelector('#estore');

roleSelect.addEventListener('change', function() {
  
  if (this.value === '1') {
      storeSelect.disabled = true;
      storeSelect.value = "";
  } else {
      storeSelect.disabled = false;
  }
});

eroleSelect.addEventListener('change', function() {

  if (this.value === '1') {
      estoreSelect.disabled = true;
      estoreSelect.value = "";
  } else {
      estoreSelect.disabled = false;
  }
});