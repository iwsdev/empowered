<?php // src/Model/Table/apps_countriesTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class Apps_countriesTable extends Table
{

    public function validationDefault(Validator $validator)
    {
        return $validator
			->notEmpty('country_name', 'A Country name is required');
    }

}
?>
