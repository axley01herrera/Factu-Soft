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
                    <div class="col-12 text-center mb-2">
                        <h1><?php echo $invoice[0]->number; ?></h1>
                    </div>
                    <div class="col-12 mb-2">
                        <div class="alert alert-warning" role="alert">
                            <?php echo lang('Text.pay_inv_not_revert_this_msg'); ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for=""><?php echo lang('Text.inv_t_dt_col_pay_type'); ?></label>
                        <select id="sel-pay-type" class="form-select">
                            <option value="" hidden></option>
                            <option value="1"><?php echo lang('Text.card'); ?></option>
                            <option value="2"><?php echo lang('Text.cash'); ?></option>
                            <option value="3"><?php echo lang('Text.transfer'); ?></option>
                        </select>
                    </div>


                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="pay-invoice-process" class="btn btn-primary"><?php echo lang('Text.btn_save'); ?></button>
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

        $('#pay-invoice-process').on('click', function() {
            let payType = $('#sel-pay-type').val();

            if (payType != "") {
                $('#pay-invoice-process').attr('disabled', true);
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('Invoice/payInvoice'); ?>",
                    data: {
                        'invoiceID': "<?php echo $invoiceID; ?>",
                        'payType': payType
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.error == 0) {
                            window.location.reload();
                        } else if (response.error == 2)
                            window.location.href = "<?php echo base_url('Home/index?session=expired'); ?>";
                        else
                            globalError();
                    },
                    error: function(error) {
                        globalError();
                    }
                });
            } else {
                $('#sel-pay-type').addClass('is-invalid');
                Swal.fire({
                    position: "top-end",
                    icon: "warning",
                    text: "<?php echo lang('Text.select_pay_type_msg'); ?>",
                    showConfirmButton: false,
                    timer: 2500
                });
            }
        });
    });
</script>