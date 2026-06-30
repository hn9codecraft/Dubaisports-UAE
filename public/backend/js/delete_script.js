//this function is used to call confirmation
function deleteRecord(delete_path,title,text,token,type,id)
{
    swal({
        title: title,
        type: type,
        showCancelButton: true,
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: true,
        closeOnCancel: true
    }, function(isConfirm) {
        if (isConfirm) {
            deleteRequest(delete_path,id,token);
        } 
    });
}
//this function  is used to check coming data is array or not
function checkLength(delete_id)
{
    var selected_length = delete_id.length;

    if(0 == selected_length){
        EmptyData();
    }else{
        var id = [];
        $.each(delete_id, function(i, ele){
            id.push($(ele).val());
        });
        deleteRecord(delete_path,title,text,token,type,id)
    }
}
//this function  is used to call delete record
function deleteRequest(delete_path,id,token)
{
    $.ajax({
        url: delete_path,
        type:'post',
        dataType:'json',
        data:{id:id,_token: token},
        beforeSend:function(){
            $('#spin').show();
        },
        complete:function(){
            
        },
        success: function(resp) {
            if(resp.type == 'error') {
                toastr.error(resp.message);
            } else {
                toastr.success(resp.message);
                $('#spin').hide();
                var redrawtable = $('#dataTable').dataTable();
                redrawtable.fnStandingRedraw();
                // location.reload();
            }
        }
    });
}
//Give Error when no data is selected
function EmptyData()
{
    swal({
       title: "Please Select a Record to delete/block",
       type:"error",
       timer: 2000,
       showConfirmButton: false 
    });
}

function reload() {
    $('#dataTable').DataTable().ajax.reload( null, false );
}