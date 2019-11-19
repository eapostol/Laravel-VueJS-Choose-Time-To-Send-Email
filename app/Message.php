<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * @var string
     * @var \Carbon\Carbon
     * @var false|string
     */

    private $title;
    private $body;

    private $delivered;
    private $send_date;
    private $date_string;
}
