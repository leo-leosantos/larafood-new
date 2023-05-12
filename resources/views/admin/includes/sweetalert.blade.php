
<script>
    @if(Session::has('success'))
        Swal.fire({
            title: {{ Session::get('success') }},
            position: 'top-end',
            icon: 'success',
            showConfirmButton: false,
            timer: 1500
        })
    @endif
</script>
<script>

$(function(){
    $(document).on('click','#delete',function(e){
        e.preventDefault();
        var link = $(this).attr("href");
                  Swal.fire({
                    title: 'Olá tudo bem?',
                    text: "Deseja Realmente deletar esse item?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href = link
                      Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                      )
                    }
                  })


    });

  });

</script>
