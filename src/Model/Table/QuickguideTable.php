<?php // src/Model/Table/QuickguideTable.php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class QuickguideTable extends Table
{

    public function validationDefault(Validator $validator)
    {
        return $validator
			->notEmpty('title', 'A title is required')
			->notEmpty('name', 'A name is required')
            ->notEmpty('status', 'A status is required');
    }
}
?>
