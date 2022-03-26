<?php namespace App\Models;

use CodeIgniter\Model;

class ActivityModel extends Model {

    protected $table = 'tbl_student_activities';

    protected $primaryKey = 'RecID';

    protected $returnType = 'array';

    protected $allowedFields = [
        'ActivityName',
        'Description',
        'StartDate',
        'EndDate',
        'Created_at',
        'Create_by',
    ];
    
}

?>