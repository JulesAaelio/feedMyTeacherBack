<?php
/**
 * Created by PhpStorm.
 * User: Jules LAURENT
 * Date: 16/10/2017
 * Time: 15:45
 */

namespace ReviewBunde\Services;
class DataFetcherService
{
    public function getTeachers()
    {
        return [
            [
                'nom' => 'A',
                'prenom' => 'B'],
            [
                'nom' => 'C',
                'prenom' => 'D']
        ];
    }
}