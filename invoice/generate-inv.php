<?php
class generateInvoice{
    function randomStr($len = 3)
    {
        // Character List to Pick from
        $chrList = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // Minimum/Maximum times to repeat character List to seed from
        $chrRepeatMin = 1; // Minimum times to repeat the seed string
        $chrRepeatMax = 10; // Maximum times to repeat the seed string

        // Length of Random String returned
        $chrRandomLength = $len;

        // The ONE LINE random command with the above variables.
        return substr(str_shuffle(str_repeat($chrList, mt_rand($chrRepeatMin,$chrRepeatMax))), 1, $chrRandomLength);
    }

    function invoiceNumber($post_date)
    {
        $date = isset($post_date) ? $post_date : date('Y-m-d');
        return '#'.$this->randomStr(2).strtotime(date('Y-m-d', strtotime($date)));
    }
    function pre($p)
    {
        echo '<pre>';
        print_r($p);
        echo '</pre>';
    }
}
// $random = new generateInvoice();
// echo $random->invoiceNumber();