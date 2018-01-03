<?php // src/Model/Table/categoryTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class CategoryTable extends Table
{

    public function validationDefault(Validator $validator)
    {
        return $validator
			->notEmpty('category_name', 'A category name is required');
    }

}
?>
