<?php namespace App\Models;

use CodeIgniter\Model;

class AnswerTypeModel extends Model {

    protected $table = 'tbl_answer_type';

    protected $primaryKey = 'RecID';

    protected $returnType = 'array';

    protected $allowedFields = [
        'Name',
        'IsActive',
    ];
    
}

?>