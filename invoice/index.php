<!DOCTYPE html>
<?php 
session_start();
include 'generate-inv.php';
$random = new generateInvoice();

$post = (object) @$_POST;
$pos = @$_POST;
$default_item = ['name'=>'','qty'=>0,'price'=>0];
$_SESSION["ss_invoice"] = isset($_SESSION["ss_invoice"]) ? $_SESSION["ss_invoice"]:[];
$_SESSION["ss_payment"] = isset($_SESSION["ss_payment"]) ? $_SESSION["ss_payment"]:[];
$_SESSION["ss_tmp_item"] = isset($_SESSION["ss_tmp_item"]) ? $_SESSION["ss_tmp_item"]:[];
// $random->pre($_SESSION["ss_tmp_item"]);
if (count($_SESSION["ss_tmp_item"]) < 1) {
    $_SESSION["ss_tmp_item"][] = $default_item;
    // $random->pre('000');
}else{
    // $random->pre('111');
    // $random->pre($post);
    $_SESSION['ss_invoice'] = [
        'inv_date'=> $post->inv_date,
        'f_name'=> $post->f_name,
        'l_name'=> $post->l_name,
        'address'=> $post->address,
        'city'=> $post->city,
        'province'=> $post->province,
        'post_code'=> $post->post_code,
        'country'=> $post->country
    ];

    $_SESSION['ss_payment'] = [
        'payment_method'=> $post->payment_method,
        'ppn'=> empty($post->ppn) ? 0:$post->ppn,
        'credit'=> empty($post->credit) ? 0:$post->credit
    ];

    if (isset($_POST['add'])) {

        $_SESSION["ss_tmp_item"][] = $default_item;
        $count_item = count($_SESSION["ss_tmp_item"]);
        for ($i=0; $i < $count_item; $i++) { 
            $dt = [
                'name'=> @$pos['name_'.$i],
                'qty'=> empty(@$pos['qty_'.$i]) ? 0:@$pos['qty_'.$i],
                'price'=> empty(@$pos['price_'.$i]) ? 0:@$pos['price_'.$i]
            ];

            $_SESSION["ss_tmp_item"][$i] = $dt;
        }
    }else if(isset($_POST['submit'])){
    //     echo "submit";
        $count_item = count($_SESSION["ss_tmp_item"]);
        for ($i=0; $i < $count_item; $i++) { 
            $dt = [
                'name'=> @$pos['name_'.$i],
                'qty'=> empty(@$pos['qty_'.$i]) ? 0:@$pos['qty_'.$i],
                'price'=> empty(@$pos['price_'.$i]) ? 0:@$pos['price_'.$i]
            ];

            $_SESSION["ss_tmp_item"][$i] = $dt;
        }
        header('Location: result-inv.php');
    }else{
        session_destroy();
        header('Location: index.php');
    }
}
if (isset($_POST['reset'])) {
session_destroy();
header('Location: index.php');
}
// $random->pre($_SESSION);
$tmp_item = $_SESSION['ss_tmp_item'];
$ss_invoice = (object) $_SESSION['ss_invoice'];
$ss_payment = (object) $_SESSION['ss_payment'];
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
        <div class="row">
            <div class="container">
                <div class="col-md-12">
                    <div class="card">
                        <form class="form-horizontal" method="post" action="index.php">
                            <div class="card-body row">
                                <h2 class="card-title center">Form Invoice</h2>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">Invoice Date</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="inv_date" value="<?=$ss_invoice->inv_date?>" placeholder="23/10/2020">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">First Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="f_name" value="<?=$ss_invoice->f_name?>" placeholder="Capt">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">Last Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="l_name" value="<?=$ss_invoice->l_name?>" placeholder="Javcksparoew">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">Address</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="address" value="<?=$ss_invoice->address?>" placeholder="Jln. Pulau Saelus II, Gg. Anggrek No. 2">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">City</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="city" value="<?=$ss_invoice->city?>" placeholder="Denpasar">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">Province</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="province" value="<?=$ss_invoice->province?>" placeholder="Bali">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">Post Code</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="post_code" value="<?=$ss_invoice->post_code?>" placeholder="80223">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">Country</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" name="country" value="<?=$ss_invoice->country?>" placeholder="Indonesia">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <hr> -->
                            <div class="card-body row">
                                <h2 class="card-title center">Item Invoice</h2>
                                <?php for ($i=0; $i < count($tmp_item); $i++) { ?>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">Item <?= $i+1 ?></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="name_<?=$i?>" value="<?=$tmp_item[$i]['name']?>" placeholder="Pembuatan website - domain.com">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">Qty</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" name="qty_<?=$i?>" value="<?=$tmp_item[$i]['qty']?>" placeholder="1">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">Price</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" name="price_<?=$i?>" value="<?=$tmp_item[$i]['price']?>" placeholder="10000">
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <!-- <hr> -->
                            <div class="card-body row">
                                <h2 class="card-title center">Payment</h2>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">Payment Method</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="payment_method" value="<?=$ss_payment->payment_method?>" placeholder="ATM Transfer">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">PPN</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" name="ppn" value="<?=$ss_payment->ppn?>" placeholder="10">
                                        </div> 
                                        <div style="padding-top: 8px;">
                                            %
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">Credit</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" name="credit" value="<?=$ss_payment->credit?>" placeholder="10000">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <hr> -->
                            <div class="border-top">
                                <div class="card-body center">
                                    <button type="submit" class="btn btn-primary" name="add" value="add">Add Item</button>
                                    <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                                    <!-- <button type="submit" class="btn btn-primary" name="reset" value="reset">Reset</button> -->
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!-- <p class="text-center hidden-print"><a href="clientarea.php">« Kembali ke Client Area</a></p> -->

    </body>

</html>