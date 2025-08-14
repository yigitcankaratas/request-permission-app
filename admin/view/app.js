$(function(){

    $('#sirket').on('change', function(){
        var company_id = $(this).val();
        if (company_id){

            $.post('view/ajax.php', {'company_id': company_id}, function(response){
                $('#yonetici1').html(response).removeAttr('disabled');
                $('#yonetici2').html(response).removeAttr('disabled');
                $('#yonetici3').html(response).removeAttr('disabled');
                $('#yonetici4').html(response).removeAttr('disabled');
            });
        } else {
            $('#yonetici1').html('<option>--Lütfen Yönetici Seçin--</option>').attr('disabled', 'disabled');
            $('#yonetici2').html('<option>--Lütfen Yönetici Seçin--</option>').attr('disabled', 'disabled');
            $('#yonetici3').html('<option>--Lütfen Yönetici Seçin--</option>').attr('disabled', 'disabled');
            $('#yonetici4').html('<option>--Lütfen Yönetici Seçin--</option>').attr('disabled', 'disabled');
        }
    });

});