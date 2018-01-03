<?php // src/Model/Table/answerTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class AnswerTable extends Table
{
    public function validationDefault(Validator $validator)
    {
        return $validator
			->notEmpty('user_id', 'A User id is required')
			->notEmpty('q_id', 'A Question id is required')
			->notEmpty('option_id', 'A Option id is required');
    }
}
?>
