<?php 
    namespace app\models;

    use Yii;
    use yii\base\Model;
    
    class SearchForm extends Model 
    {
        public $breed;

        public function rules()
        {
            return [
                [[ 'breed' ], 'required' ]
            ];
        }
    }
?>