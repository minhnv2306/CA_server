<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Van Minh
 * Date: 3/15/2018
 * Time: 11:12 PM
 */
if (!function_exists('setComment')) {
    function setComment($status_before, $status_after, $note)
    {
        return $status_before . '->' . $status_after . ': ' . $note;
    }
}