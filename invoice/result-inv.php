<?php 
session_start();
include 'generate-inv.php';
$random = new generateInvoice();

// $random->pre($_SESSION);
$tmp_item = $_SESSION['ss_tmp_item'];
$ss_invoice = (object) $_SESSION['ss_invoice'];
$ss_payment = (object) $_SESSION['ss_payment'];
$date = explode('/', $ss_invoice->inv_date);
// $random->pre($date);
$sub_total = 0;
for ($i=0; $i < count($tmp_item); $i++) {
    $sub_total += $tmp_item[$i]['price'] * $tmp_item[$i]['qty'];
}
$ppn = $sub_total - ($sub_total - $sub_total/100 * $ss_payment->ppn);
$total = $sub_total + $ppn - $ss_payment->credit;
?>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PGDS - Invoice</title>

        <link href="dist/css/mystyle.min.css" rel="stylesheet">
        <link href="dist/css/myinvoice.css" rel="stylesheet">
        <link href="dist/css/mystyle.css" rel="stylesheet">

    </head>

    <body>
        
        <div class="container-fluid invoice-container">

            <div class="row invoice-header">
                <div class="invoice-col">

                    <h1 style="font-weight: 900;color: blue;">PGDS</h1>
                    <h3>Invoice <?= $random->invoiceNumber($date[2].'-'.$date[1].'-'.$date[0])?></h3>
                    <!-- <h3>Invoice <?= $random->invoiceNumber($date[2].'-10-23')?></h3> -->

                </div>
                <div class="invoice-col text-center">

                    <div class="invoice-status">
                        <span class="paid">Paid<br><span style="font-size:11px;">(Terima Kasih Atas Pembayaran
                                Anda)</span></span>
                    </div>


                </div>
            </div>

            <hr>

            <div class="row">
                <div class="invoice-col right">
                    <strong>Dibayarkan kepada</strong>
                    <address class="small-text">
                        PGDS (DANANG)<br>
                        Jln. Pulau Saelus II, Gg. Anggrek No. 2<br>
                        Denpasar, Bali 80223<br>
                        Indonesia<br>
                        PHONE / SMS : +62 8175 50189<br>
                    </address>
                </div>
                <div class="invoice-col">
                    <strong>Untuk</strong>
                    <address class="small-text"><?=$ss_invoice->f_name?> <?=$ss_invoice->l_name?><br>
                    <?=$ss_invoice->address?><br>
                    <?=$ss_invoice->city?>, <?=$ss_invoice->province?> <?=$ss_invoice->post_code?><br>
                    <?=$ss_invoice->country?>
                </address>
                </div>
            </div>

            <div class="row">
                <div class="invoice-col right">
                    <strong>Metode Bayar</strong><br>
                    <span class="small-text">
                    <?=$ss_payment->payment_method?>
                    </span>
                    <br><br>
                </div>
                <div class="invoice-col">
                    <strong>Tanggal Invoice</strong><br>
                    <span class="small-text">
                    <?=$ss_invoice->inv_date?><br><br>
                    </span>
                </div>
            </div>

            <br>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Item Invoice</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <td><strong>Deskripsi</strong></td>
                                    <td><strong>Qty</strong></td>
                                    <td width="20%" class="text-center"><strong>Jumlah</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i=0; $i < count($tmp_item); $i++) { ?>
                                <tr>
                                    <td><?=$tmp_item[$i]['name']?></td>
                                    <td><?=$tmp_item[$i]['qty']?></td>
                                    <td class="text-center">Rp. <?=number_format($tmp_item[$i]['price'] * $tmp_item[$i]['qty'], 0, '', '.')?> </td>
                                </tr>
                                <?php } ?>
                                <tr><td colspan="4"></td></tr>
                                <tr>
                                    <td class="total-row text-right" colspan="2"><strong>Sub Total</strong></td>
                                    <td class="total-row text-center">Rp. <?=number_format($sub_total, 0, '', '.')?> </td>
                                </tr>
                                
                                <tr>
                                    <td class="total-row text-right" colspan="2"><strong>PPN <?=$ss_payment->ppn?>%</strong></td>
                                    <td class="total-row text-center">Rp. <?=number_format($ppn, 0, '', '.')?> </td>
                                </tr>

                                <tr>
                                    <td class="total-row text-right" colspan="2"><strong>Credit</strong></td>
                                    <td class="total-row text-center">Rp. <?=number_format($ss_payment->credit, 0, '', '.')?> </td>
                                </tr>
                                <tr>
                                    <td class="total-row text-right" colspan="2"><strong>Total</strong></td>
                                    <td class="total-row text-center">Rp. <?=number_format($total, 0, '', '.')?> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <p></p>

            <div class="pull-right btn-group btn-group-sm hidden-print">
                <a href="javascript:window.print()" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                <!-- <a href="dl.php?type=i&amp;id=184478" class="btn btn-default"><i class="fa fa-download"></i> Unduh</a> -->
            </div>

        </div>

        <!-- <p class="text-center hidden-print"><a href="clientarea.php">« Kembali ke Client Area</a></p> -->

    </body>

</html>