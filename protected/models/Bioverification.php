<?php

/**
 * This is the model class for table "bioverification".
 *
 * The followings are the available columns in table 'bioverification':
 * @property integer $Id
 * @property integer $CNIC
 * @property string $imageBuffer1
 * @property string $regMin1
 * @property string $regMin2
 * @property string $regVfn
 * @property string $fingerImageFile
 */
class Bioverification extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bioverification';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id, CNIC, imageBuffer1, regMin1, regMin2, regVfn, fingerImageFile', 'required'),
			array('Id, CNIC', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id, CNIC, imageBuffer1, regMin1, regMin2, regVfn, fingerImageFile', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'CNIC' => 'Cnic',
			'imageBuffer1' => 'Image Buffer1',
			'regMin1' => 'Reg Min1',
			'regMin2' => 'Reg Min2',
			'regVfn' => 'Reg Vfn',
			'fingerImageFile' => 'Finger Image File',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('Id',$this->Id);
		$criteria->compare('CNIC',$this->CNIC);
		$criteria->compare('imageBuffer1',$this->imageBuffer1,true);
		$criteria->compare('regMin1',$this->regMin1,true);
		$criteria->compare('regMin2',$this->regMin2,true);
		$criteria->compare('regVfn',$this->regVfn,true);
		$criteria->compare('fingerImageFile',$this->fingerImageFile,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Bioverification the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
