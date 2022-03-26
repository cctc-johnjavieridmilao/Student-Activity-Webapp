<?php namespace App\Models;

use CodeIgniter\Model;

class DepartmentModel extends Model {

    protected $table = 'tbl_department';

    protected $primaryKey = 'DeptID';

    protected $returnType = 'array';

    protected $allowedFields = [
        'DeptName',
        'IsActive',
        'Created_at',
    ];
    
}

?>