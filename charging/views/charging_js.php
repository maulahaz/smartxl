<script>
$('#inpSearchDate').hide();
// $('#inpSearchText').hide();
    $('#optSearch').on('change', function(ev){
        ev.preventDefault();
        // alert('Search changed');
        // Swal.fire({
        //     icon: 'error',
        //     title: 'Oops...',
        //     text: 'Something went wrong!',
        //     footer: '<a href>Why do I have this issue?</a>'
        //     });
        v = $(this).val();
        if(v == "Material" || v == "ChargeBy" || v == "Lotnum"){
            $('#inpSearchDate').hide();
            $('#inpSearchText').show();
        }else if($(this).val() == "Date"){
            $('#inpSearchDate').show();
            $('#inpSearchText').hide();
        }
    });

    $('#btnSearch').on('click', function(ev){
        // Swal.fire('Any fool can use a computer')
        // alert('Click');
    });
</script>