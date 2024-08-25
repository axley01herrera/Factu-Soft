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
                        <p class="mb-3 card-subtitle">
                            <?php echo lang('Text.inv_add_service_msg'); ?>
                        </p>
                    </div>

                    <div class="col-12 mb-5">
                        <select id="sel-service" class="form-control">
                            <option value=""></option>
                            <?php foreach ($services as $s) { ?>
                                <option value="<?php echo $s->id; ?>"><?php echo $s->name . ' ' . getMoneyFormat($config[0]->currency, $s->price); ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-12 mb-2">
                        <label for="item-description"><?php echo lang('Text.service_text_description'); ?></label>
                        <textarea id="item-description" class="form-control required-item" rows="3"></textarea>
                    </div>

                    <div class="col-6 mb-2">
                        <label for=""><?php echo lang('Text.inv_dt_item_col_qty'); ?></label>
                        <input type="number" id="item-qty" class="form-control required-item">
                    </div>

                    <div class="col-6 mb-2">
                        <label for=""><?php echo lang('Text.inv_dt_item_col_amount'); ?></label>
                        <input type="text" id="item-price" class="form-control required-item">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="save-item" class="btn btn-primary"><?php echo lang('Text.btn_save'); ?></button>
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

        let itemServiceID = "";
        const services = <?php echo json_encode($services); ?>

        $('#sel-service').select2({
            placeholder: '<?php echo lang('Text.menu_services'); ?>',
            dropdownParent: $('#modal')
        }).on('change', function() {
            let serviceID = $(this).val();

            for (let i = 0; i < services.length; i++) {
                if (services[i].id == serviceID) {
                    $('#item-description').val(services[i].name);
                    $('#item-qty').val(1);
                    $('#item-price').val(services[i].price);
                    itemServiceID = serviceID;
                    break;
                }
            }
        });

        $('#save-item').on('click', function() {
            let require = checkRequiredItems();

            if (require == 0) {
                $('#save-item').attr('disabled', true);
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('Invoice/addLineItemProcess'); ?>",
                    data: {
                        'invoiceID': "<?php echo $invoiceID; ?>",
                        'desc': $('#item-description').val(),
                        'qty': $('#item-qty').val(),
                        'price': $('#item-price').val(),
                        'serviceID': itemServiceID
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.error == 0) {
                            window.location.reload();
                        } else if (response.error == 2) {
                            window.location.href = "<?php echo base_url('Home/index?session=expired'); ?>";
                        } else {
                            globalError();
                        }
                        $('#save-item').removeAttr('disabled');
                    },
                    error: function(error) {
                        $('#save-item').removeAttr('disabled');
                        globalError();
                    }
                });
            }
        });

        function checkRequiredItems() {
            let res = 0;
            let value = "";

            $('.required-item').each(function() {
                value = $(this).val();
                if (value == "") {
                    res = 1;
                    $(this).addClass('is-invalid');
                }
            })

            return res;
        }
    });
</script>