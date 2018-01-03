<?php // src/Model/Table/IntroductionTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class IntroductionTable extends Table
{

    public function validationDefault(Validator $validator)
    {
        return $validator
			->notEmpty('title', 'A title is required')
			->notEmpty('name', 'A name is required')
            ->notEmpty('image', 'A image is required')
            ->notEmpty('status', 'A status is required');
    }
}
?>
