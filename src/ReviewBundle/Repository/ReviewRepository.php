<?php
/**
 * Created by PhpStorm.
 * User: Alexandra
 * Date: 27/09/2017
 * Time: 16:22
 */

namespace ReviewBundle\Repository;
use ReviewBundle\Entity\Review;
use ReviewBundle\Entity\User;

class ReviewRepository
{

    public function getAllReviews()
    {
        $senders = [
            new User('Tartan', 'PION'),
            new User('Leni', 'BARS'),
            new User('Sam', 'LECASSE')
        ];
        $reviews = [
            new Review(5, 'tip_top', 0, 'pas tip top', $senders[0]),
            new Review(2, 'tik tok', 5, 'Make the party non stop', $senders[1]),
            new Review(5, 'MA-CHA-LAH LE PROF', 1, 'Pas écouté. Je regardais le prof', $senders[2])
        ];

        return $reviews;
    }
}