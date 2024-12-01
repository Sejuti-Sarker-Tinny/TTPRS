// Data Table
$(document).ready( function () {
    $('#alltableinfo').DataTable({
        ordering:  false,
        searching: true,
        paging: true,
        select: true,
        //pageLength: 10
    });
} );



$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Delete modal
$(document).on("click", "#delete", function () {
    var deleteID = $(this).data('id');
    $(".modal_card #modal_id").val( deleteID );
});

// Add spot
// District under Division dependency field
$(document).ready(function(){
    $('select[id="division_id"]').on('change',function(){
    var div_id= $(this).val();
    if(div_id!=''){
    $.ajax({
        type:"GET",
        dataType:"json",
        //url:"{{url('dashboard/spot/add/district/under/division')}}/"+div_id,
        url:window.origin+"/dashboard/spot/add/district/under/division/"+div_id,
        success:function(data){
        $('select[id="district_id"]').empty();
        $('select[id="district_id"]').append('<option value="">Select District</option>');
            $.each(data, function(key, value){
                $('select[id="district_id"]').append('<option value="'+value.district_id+'">'+value.district_name+'</option>');
            });
        }
    });
    }else{
        $('select[id="district_id"]').empty('');
        $('select[id="district_id"]').append('<option value="">Select District</option>');
    }
});
});

// Spot photo preview
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#spot_photo_preview')
                .attr('src', e.target.result)
                .width(160)
                .height(100);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

// User photo preview
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#user_photo_preview')
                .attr('src', e.target.result)
                .width(100)
                .height(100);
        };

        reader.readAsDataURL(input.files[0]);
    }
}
