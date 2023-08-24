$(document).ready(function() {
    $(".delete").on('click', function() {

        let id = $(this).data('id');
        let dormitoryContainer = $(this).parent().parent();
        let url = $(this).data('url');
        let csrf = $(this).data('csrf');

        $.confirm({
            title: 'Confirm!',
            content: 'Are you sure to delete?',
            buttons: {
                confirm: function() {
                    $.ajax({
                        url:url+id,
                        type:'Delete',
                        data:{
                            _token:csrf
                        },
                        success:function(res){
                            if(res.success){
                                toastr.success(res.success);
                                setTimeout(() => {
                                    dormitoryContainer.remove();
                                }, 2000);
                            }else{
                                toastr.error('Please check again'); 
                            }
                        }
                    })
                },
                cancel: function() {
                    $.alert('Canceled!');
                }
            }
        });
    })
})
