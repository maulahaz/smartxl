<script>

const myBaseURL = '<?php echo base_url(); ?>';

$(document).on('click', '#btnAdd_Ourteams', function(ev){
    ev.preventDefault();
    let submit_url = myBaseURL+'ourteams/manage';

    $('#modlOurteams .modal-header #modal-title').text('Add New Ourteams');
    $('#modlOurteams .modal-footer #btnSubmit_Ourteams').text('Save');
    $('#modlOurteams #frmOurteams').attr('action', submit_url);
    $('#modlOurteams').modal('show');
});

</script>