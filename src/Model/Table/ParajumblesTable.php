<?php // src/Model/Table/parajumblesTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ParajumblesTable extends Table
{
    public function validationDefault(Validator $validator)
    {
        return $validator
			->notEmpty('q_id', 'A Question id is required')
			->notEmpty('parajumble_name', 'A Parajumble name is required');
    }
}
?>
