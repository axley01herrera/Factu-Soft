<div class="modal fade show" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal" style="display: block;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title">
                    <?php echo $modalTitle; ?>
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <label for="serie-name" class="form-label   "><?php echo lang('Text.inv_name_serial'); ?></label>
                        <input type="text" id="serie-name" class="form-control required" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-save-serie" class="btn btn-primary"><?php echo lang('Text.btn_save'); ?></button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#modal').modal('show');

        $('#modal').on('hidden.bs.modal', function(event) {
            $('#app-modal').html('');
        });

        $('#btn-save-serie').on('click', function() {
            let require = checkRequiredValues();

            if (require == 0) {
                $('#btn-save-serie').attr('disabled', true);
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('Invoice/createSerieProcess'); ?>",
                    data: {
                        'name': $('#serie-name').val()
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.error == 0) {
                            $('#modal').modal('hide');;
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                text: "<?php echo lang('Text.inv_serial_created')?>" + '..!',
                                showConfirmButton: false,
                                timer: 2500
                            });
                            setTimeout(() => {
                                window.location.reload();
                            }, 2600);
                        } else if (response.error == 2) {
                            window.location.href = "<?php echo base_url('Home/index?session=expired'); ?>";
                        } else {
                            globalError();
                        }
                        $('#btn-save-serie').removeAttr('disabled');
                    },
                    error: function(error) {
                        $('#btn-save-serie').removeAttr('disabled');
                        globalError();
                    }
                });
            } else {
                Swal.fire({
                    position: "top-end",
                    icon: "warning",
                    text: "<?php echo lang("Text.msg_required_values"); ?>..!",
                    showConfirmButton: false,
                    timer: 2500
                });
            }
        });

        function checkRequiredValues() {
            let result = 0;
            let value = "";

            $('.required').each(function() {
                value = $(this).val();
                if (value == "") {
                    $(this).addClass('is-invalid');
                    result = 1;
                }
            });

            return result;
        }
    });
</script>