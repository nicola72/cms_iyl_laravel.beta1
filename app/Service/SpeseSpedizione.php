<?php
namespace App\Service;


use App\Model\Country;

class SpeseSpedizione
{
    public static function get(Country $nazione, $peso, $importo)
    {
        //per ITALIA
        if($nazione->id == "101")
        {
            if($importo < 49)
            {
                return 6;
            }
            return 0;
        }
        //per USA
        elseif($nazione->id == "181")
        {
            if($peso > 0 && $peso <= 5)
            {
                return 59;
            }
            elseif ($peso > 5 && $peso <= 10)
            {
                return 79;
            }
            elseif($peso > 10 && $peso <= 15)
            {
                return 119;
            }
            elseif($peso > 15 && $peso <= 20)
            {
                return 159;
            }
            elseif($peso > 20 && $peso <= 30)
            {
                return 189;
            }
            elseif($peso > 30 && $peso <= 50)
            {
                return 239;
            }
            elseif($peso > 50 && $peso <= 100)
            {
                return 390;
            }
            else
            {
                return 690;
            }
        }
        //per EUROPA
        elseif($nazione->is_europa == 1)
        {
            $extra_dogana = [186,137,2,5,28,30,93,113,117,128,130,150,170,196,198];

            if($peso > 0 && $peso <= 15)
            {
                if(in_array($nazione->id,$extra_dogana)){ return 39 + 50; }
                return 39;
            }
            elseif($peso > 15 && $peso <= 20)
            {
                if(in_array($nazione->id,$extra_dogana)){ return 49 + 50; }
                return 49;
            }
            elseif($peso > 20 && $peso <= 30)
            {
                if(in_array($nazione->id,$extra_dogana)){ return 59 + 50; }
                return 59;
            }
            elseif($peso > 30 && $peso <= 50)
            {
                if(in_array($nazione->id,$extra_dogana)){ return 69 + 50; }
                return 69;
            }
            elseif($peso > 50 && $peso <= 100)
            {
                if(in_array($nazione->id,$extra_dogana)){ return 99 + 50; }
                return 99;
            }
            else
            {
                if(in_array($nazione->id,$extra_dogana)){ return 290 + 50; }
                return 290;
            }
        }
        // NON EUROPA
        else
        {
            if($peso > 0 && $peso <= 5)
            {
                return 69;
            }
            elseif ($peso > 5 && $peso <= 10)
            {
                return 109;
            }
            elseif($peso > 10 && $peso <= 15)
            {
                return 159;
            }
            elseif($peso > 15 && $peso <= 20)
            {
                return 199;
            }
            elseif($peso > 20 && $peso <= 30)
            {
                return 239;
            }
            elseif($peso > 30 && $peso <= 50)
            {
                return 299;
            }
            elseif($peso > 50 && $peso <= 100)
            {
                return 490;
            }
            else
            {
                return 790;
            }
        }
    }
}