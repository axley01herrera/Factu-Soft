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
                <div class="col-12 mb-2">
                        <div class="alert alert-warning" role="alert">
                            <?php echo lang('Text.pay_inv_not_revert_this_msg'); ?>
                        </div>
                    </div>

                    <div class="col-12 text-center mb-2">
                        <h1><?php echo $invoice[0]->number; ?></h1>
                    </div>

                    <div class="col-12">
                        <label for=""><?php echo lang('Text.inv_t_dt_col_pay_type'); ?></label>
                        <select id="sel-pay-type" class="form-select">
                             <option value="0" hidden></option>
                            <option value="1"><?php echo lang('Text.card'); ?></option>
                            <option value="2"><?php echo lang('Text.cash'); ?></option>
                            <option value="3"><?php echo lang('Text.transfer'); ?></option>
                        </select>
                    </div>

                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-save" class="btn btn-primary"><?php echo lang('Text.btn_save'); ?></button>
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
    });
</script>