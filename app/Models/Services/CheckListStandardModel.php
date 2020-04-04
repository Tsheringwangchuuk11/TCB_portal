<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckListStandardModel extends Model
{
    protected $primaryKey = 'checklist_id';
    public $table='t_checklist_standard';
}
