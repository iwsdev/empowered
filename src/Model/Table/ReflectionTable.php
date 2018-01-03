<?php // src/Model/Table/ReflectionTable.php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ReflectionTable extends Table
{

    public function validationDefault(Validator $validator)
    {
        return $validator
			->notEmpty('title', 'A title is required')
			->notEmpty('date', 'A date is required')
            ->notEmpty('description', 'A description is required')
            ->notEmpty('status', 'A status is required');
    }
}
?>
