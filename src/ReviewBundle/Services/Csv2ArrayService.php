<?php
/**
 * Created by PhpStorm.
 * User: Jules LAURENT
 * Date: 17/10/2017
 * Time: 16:31
 */

namespace ReviewBundle\Services;


class Csv2ArrayService
{
    public function convert($filepath, $delimiter = ',')
    {
        if(!file_exists($filepath) || !is_readable($filepath)) {
            return FALSE;
        }

        $header = NULL;
        $data = array();

        if (($handle = fopen($filepath, 'r')) !== FALSE) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
                if(!$header) {
                    $header = $row;
                } else {
                    $data[] = array_combine($header, $row);
                }
            }
            fclose($handle);
        }
        return $data;
    }
}