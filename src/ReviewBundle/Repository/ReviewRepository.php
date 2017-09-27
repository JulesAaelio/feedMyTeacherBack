<?php

/**
 * Created by PhpStorm.
 * User: Alexandra
 * Date: 27/09/2017
 * Time: 16:22
 */
class ReviewRepository
{

    public function getAllReviews(): array
    {
        $senders = [
            new User('Tartan','PION'),
            new User('Leni','BARS'),
            new User('Sam','LECASSE')
        ];
        $reviews = [
            new Review(5,'tip_top',0,'pas tip top',$senders[0]),
            new Review(2,'tic_toc',5,'Make the party non stop',$senders[1]),
            new Review(5,'MA-CHA-LAH LE PROF',5,'Pas écouté. Je regardais le prof',$senders[2])
        ];

        return $reviews;
    }
}