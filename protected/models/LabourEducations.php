<?php

/**
 * This is the model class for table "labour_educations".
 *
 * The followings are the available columns in table 'labour_educations':
 * @property integer $id
 * @property integer $labour_id
 * @property integer $education_type_id
 * @property string $board
 * @property string $passing_year
 * @property string $organization_name
 * @property string $degree
 */
class LabourEducations extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'labour_educations';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('labour_id, education_type_id, board, passing_year, organization_name, degree', 'required'),
			array('labour_id, education_type_id', 'numerical', 'integerOnly'=>true),
			array('board, passing_year, organization_name, degree', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, labour_id, education_type_id, board, passing_year, organization_name, degree', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'labour_id' => 'Labour',
			'education_type_id' => 'Education Type',
			'board' => 'Board',
			'passing_year' => 'Passing Year',
			'organization_name' => 'Organization Name',
			'degree' => 'Degree',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('labour_id',$this->labour_id);
		$criteria->compare('education_type_id',$this->education_type_id);
		$criteria->compare('board',$this->board,true);
		$criteria->compare('passing_year',$this->passing_year,true);
		$criteria->compare('organization_name',$this->organization_name,true);
		$criteria->compare('degree',$this->degree,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LabourEducations the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
