<?php // src/Model/Table/questionsTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class QuestionsTable extends Table
{
    public function validationDefault(Validator $validator)
    {
        return $validator
			->notEmpty('question', 'A question is required');
    }
}
?>
