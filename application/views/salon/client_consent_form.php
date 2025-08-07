<?php if (!empty($consent_form)) { ?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
    .error{
        color:red;
    }
    .page {
        width: 21.01cm;
        height: auto;
        margin: 1cm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    .under-page {
        min-height: 25.62cm;
    }
    .header_container{
        display: flex;
        align-items: center;
    }

    .header_container span {
    border-left: 2px solid;
    height: 80px;
    margin-left: 10px;
    display: flex
;
    align-items: center;
}

.info{
    display: flex
;
    flex-direction: column;
    gap: 8px;
    flex-wrap: wrap;
    justify-content: center;
    align-items: start;
    margin-bottom: 24px;
    font-size: 14px;
    letter-spacing: 0.5px;

}

.header_container span b{
    margin-left: 20px;
    font-size: 16px;
    font-family: 'Arial';
    letter-spacing: 0.4;

}
    .comp_logo {
            width: 90px;
            height: 90px;
            border-radius: 50%;

      
        }


        .comp_logo img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
        }
    
    @page {
        size: A4;
        margin: 0;
    }
    @media print {
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
        
    }
</style>
<script>
    $(document).ready(function () {
        $.validator.addMethod("atLeastOneChecked", function (value, element) {
            return $("input[name='consent[]']:checked").length > 0;
        }, "You must agree to at least one of the terms.");
        $.validator.addMethod("allChecked", function (value, element) {
            return $("input[name='consent[]']").length === $("input[name='consent[]']:checked").length;
        }, "You must agree to all terms.");

        $("#consentform").validate({
            rules: {
                "consent[]": {
                    allChecked: true
                }
            },
            messages: {
                "consent[]": {
                    allChecked: "Please agree terms & conditions."
                }
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });
</script>
<div class="book">
    <div class="page">
        <div class="under-page">
            <section style="width: 100%; height: 500px; padding: 0.5cm 1.5cm;">
                <form method="post" id="consentform">
                    <div class="col-md-12 header_container" style="text-align: center;">
                        <div class="comp_logo">
                            <img src="<?=base_url()?>assets/images/napito_logo.jpg" alt="">
                        </div>
                        <span><b>Consent Form</b></span>
                    </div>
                    <div class="middal" style="background-image: url('<?=base_url();?>assets/img/image89.png'); font-family: sans-serif; font-weight: 400; background-size: cover; background-position: center center;">
                        <div class="row" style="padding-bottom:30px;">
                            <div class="col-md-6" style="text-align: left;">
                                <span></span>
                            </div>
                            <div class="col-md-6" style="text-align: right;">
                                <span><b>Date: </b><?php echo date('d-m-Y', strtotime($consent_form->created_on)); ?></span>
                            </div>
                        </div>
                        <div class="info">
                        <p><strong>Client Name:</strong> <span><?=$consent_form->full_name;?></span></p>
                        <p><strong>Client No.:</strong> <span><?=$consent_form->customer_phone;?></span></p>
                       <!-- <div style="width: 150px; height: 50px; overflow: auto;"></div> -->
                        <p><strong>Client Requirement:</strong> <span><?=$consent_form->requirement;?></span></p>
                        <p><strong>Client Purpose:</strong> <span><?=$consent_form->purpose;?></span></p>
                       <!-- <div style="width: 150px; height: 50px; overflow: auto;"></div> -->
                        <p><strong>Condition:</strong> <span><?=$consent_form->condition;?></span></p>
                        <p><strong>Stylist Suggest:</strong> <span><?=$consent_form->stylist_suggest;?></span></p>
                        <p><strong>Stylist Decide result:</strong> <span><?=$consent_form->stylist_decide_result;?></span></p>
                        <p><strong>Stylist Name:</strong> <span><?=$consent_form->stylist_name;?></span></p>
                       <!-- <div style="width: 150px; height: 50px; overflow: auto;"></div> -->
                        <p><strong>Client Decision:</strong> <span><?=$consent_form->customer_decision;?></span></p>
                        <p><strong>Decision Result:</strong> <span><?=$consent_form->decision_result;?></span></p>
                       <!-- <div style="width: 150px; height: 50px; overflow: auto;"></div> -->
                        </div>
                    </div>
                    <div class="terms">
                        <label>Agree Terms & Conditions</label>
                        <?php if ($consent_form->service_consent_agree_text != "") { ?>
                            <p>
                                <input type="checkbox" name="consent[]" value="service_consent"><span><?=$consent_form->service_consent_agree_text;?></span>
                            </p>
                        <?php } ?>
                        <?php if ($consent_form->product_consent_agree_text != "") { ?>
                            <p>
                                <input type="checkbox" name="consent[]" value="product_consent"><span><?=$consent_form->product_consent_agree_text;?></span>
                            </p>
                        <?php } ?>
                        <label id="consent[]-error" class="error" for="consent[]" style="display:none;">Please agree to at least one of the terms.</label>
                    </div>
                   <!-- <div style="width: 150px; height: 50px; overflow: auto;"></div> -->
                    <input type="hidden" name="consent_form_id" id="consent_form_id" value="<?=$consent_form->id;?>">
                    <input type="hidden" name="consent_link" id="consent_link" value="<?=base_url();?>client_consent_form?consent=<?=base64_encode($consent_form->id);?>">
                    <div>
                        <button type="submit" id="submit_consent" name="submit_consent" value="submit_consent" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
<?php } ?>
