<?php
class MyActiveRecord extends CActiveRecord {
    private static $dbrails = null;
 
    protected static function getRailDbConnection()
    {
        if (self::$dbrails !== null)
            return self::$dbrails;
        else
        {
            self::$dbrails = Yii::app()->dbrails;
            if (self::$dbrails instanceof CDbConnection)
            {
                self::$dbrails->setActive(true);
                return self::$dbrails;
            }
            else
                throw new CDbException(Yii::t('yii','Active Record requires a "db" CDbConnection application component.'));
        }
    }
}


?>