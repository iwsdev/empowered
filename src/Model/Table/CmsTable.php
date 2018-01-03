<?php // src/Model/Table/CmsTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class CmsTable extends Table
{
    public function validationDefault(Validator $validator)
    {
        return $validator
			->notEmpty('title', 'A title id is required')
            ->notEmpty('name', 'A name is required')
            ->notEmpty('status', 'A status is required');
    }
}
?>
