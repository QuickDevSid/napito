<?php if (!empty($consent_form)) { ?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="<?= base_url(); ?>invoice_assests/jquery.min.js"></script>
<script src="<?= base_url(); ?>invoice_assests/jspdf.min.js"></script>
<script src="<?= base_url(); ?>invoice_assests/html2canvas.min.js"></script>
<script src="<?= base_url(); ?>invoice_assests/main.js"></script>

<style>
    .error {
        color: red;
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
        .logo {
            width: 100%;
            height: auto;
        }
        #printButton, #pdfButton {
            display: none; /* Hide buttons during print */
        }
    }
</style>

<div class="text-center" style="margin: 20px;">
    <button id="printButton" class="btn btn-primary">Print</button>
    <!-- <button id="pdfButton" class="btn btn-success">Download PDF</button> -->
</div>

<div class="book">
    <div class="page">
        <div class="under-page">
            <section style="width: 100%; height: 500px; padding: 0.5cm 1.5cm;">
                <div class="col-md-12" style="text-align: center;">
                    <span><b>Consent Form</b></span>
                </div>
                <div class="middal" style="background-image: url('<?= base_url(); ?>assets/img/image89.png'); font-family: sans-serif; font-weight: 400; background-size: cover; background-position: center center;">
                    <div class="row" style="padding-bottom: 30px;">
                        <div class="col-md-6" style="text-align: left;">
                            <span></span>
                        </div>
                        <div class="col-md-6" style="text-align: right;">
                            <span><b>Date: </b><?php echo date('d-m-Y', strtotime($consent_form->created_on)); ?></span>
                        </div>
                    </div>
                    <p><strong>Client Name:</strong> <span><?= $consent_form->full_name; ?></span></p>
                    <p><strong>Client No.:</strong> <span><?= $consent_form->customer_phone; ?></span></p>
                    <div style="width: 150px; height: 50px; overflow: auto;"></div>
                    <p><strong>Client Requirement:</strong> <span><?= $consent_form->requirement; ?></span></p>
                    <p><strong>Client Purpose:</strong> <span><?= $consent_form->purpose; ?></span></p>
                    <div style="width: 150px; height: 50px; overflow: auto;"></div>
                    <p><strong>Condition:</strong> <span><?= $consent_form->condition; ?></span></p>
                    <p><strong>Stylist Suggest:</strong> <span><?= $consent_form->stylist_suggest; ?></span></p>
                    <p><strong>Stylist Decide result:</strong> <span><?= $consent_form->stylist_decide_result; ?></span></p>
                    <p><strong>Stylist Name:</strong> <span><?= $consent_form->stylist_name; ?></span></p>
                    <div style="width: 150px; height: 50px; overflow: auto;"></div>
                    <p><strong>Client Decision:</strong> <span><?= $consent_form->customer_decision; ?></span></p>
                    <p><strong>Decision Result:</strong> <span><?= $consent_form->decision_result; ?></span></p>
                    <div style="width: 150px; height: 50px; overflow: auto;"></div>
                </div>
                <div>
                    <label>Agree Terms & Conditions</label>
                    <?php if ($consent_form->service_consent_agree_text != "") { ?>
                        <p>
                            <span><?= $consent_form->service_consent_agree_text; ?></span>
                        </p>
                    <?php } ?>
                    <?php if ($consent_form->product_consent_agree_text != "") { ?>
                        <p>
                            <span><?= $consent_form->product_consent_agree_text; ?></span>
                        </p>
                    <?php } ?>
                </div>
                <div style="width: 150px; height: 50px; overflow: auto;"></div>
            </section>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Print functionality
        $("#printButton").click(function () {
            $("#printButton, #pdfButton").hide(); // Hide buttons before printing
            window.print();
            $("#printButton, #pdfButton").show(); // Show buttons again after printing
        });

        // PDF Download functionality
        $("#pdfButton").click(function () {
            $("#printButton, #pdfButton").hide(); // Hide buttons before PDF generation
            html2canvas(document.querySelector(".page")).then(canvas => {
                const imgData = canvas.toDataURL('image/png');
                const pdf = new jsPDF();
                const imgWidth = 190; // Set the desired width
                const pageHeight = pdf.internal.pageSize.height;
                const imgHeight = canvas.height * imgWidth / canvas.width;
                let heightLeft = imgHeight;

                let position = 0;

                pdf.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;

                while (heightLeft >= 0) {
                    position = heightLeft - imgHeight;
                    pdf.addPage();
                    pdf.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;
                }

                pdf.save('consent_form.pdf');
                $("#printButton, #pdfButton").show(); // Show buttons again after PDF download
            });
        });
    });
</script>
<?php } ?>
