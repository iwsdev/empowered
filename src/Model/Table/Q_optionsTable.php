<?php // src/Model/Table/q_optionsTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class Q_optionsTable extends Table
{
    public function validationDefault(Validator $validator)
    {
        return $validator
			->notEmpty('q_id', 'A Question id is required')
			->notEmpty('option_name', 'A Option name is required');
    }
}
?>
