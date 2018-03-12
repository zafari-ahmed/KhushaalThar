<?php

/**
 * This is the model class for table "client_company_requisition_details".
 *
 * The followings are the available columns in table 'client_company_requisition_details':
 * @property integer $id
 * @property integer $requisition_id
 * @property integer $type
 * @property string $skill
 * @property integer $count
 * @property string $date_from
 * @property string $date_to
 * @property integer $status
 * @property string $remarks
 * @property integer $person_id
 * @property string $person
 * @property string $close_date
 *
 * The followings are the available model relations:
 * @property ClientCompanyRequisitions $requisition
 * @property LaborRequisitions[] $laborRequisitions
 */
class ClientCompanyRequisitionDetailsLive extends MyActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function getDbConnection()
    {
        return self::getRailDbConnection();
    }
	public function tableName()
	{
		return 'client_company_requisition_details';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('requisition_id, type, skill, count, date_from, date_to, status, remarks, person_id, person, close_date', 'required'),
			array('requisition_id, type, count, status, person_id', 'numerical', 'integerOnly'=>true),
			array('skill, person', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, requisition_id, type, skill, count, date_from, date_to, status, remarks, person_id, person, close_date', 'safe', 'on'=>'search'),
		);
	}

	
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'requisition' => array(self::BELONGS_TO, 'ClientCompanyRequisitions', 'requisition_id'),
			'laborRequisitions' => array(self::HAS_MANY, 'LaborRequisitionsLive', 'requisition_id'),
			'laborRequisitionsActiveComAtt' => array(self::HAS_MANY, 'LaborRequisitions', 'requisition_id','condition' => "`status` !=4 AND `status` !=0 "),
			'laborRequisitionsActiveCom' => array(self::HAS_MANY, 'LaborRequisitions', 'requisition_id','condition' => "`status` !=4 "),
			'laborRequisitionsActive' => array(self::HAS_MANY, 'LaborRequisitions', 'requisition_id','condition' => "`status` !=2 "),
			'laborRequisitionsHired' => array(self::STAT, 'LaborRequisitions', 'requisition_id','condition' => "`status` = 1 "),
			'laborRequisitionsHiredDet' => array(self::HAS_MANY, 'LaborRequisitions', 'requisition_id','condition' => "`status` = 1 "),
			'laborRequisitionsCount' => array(self::STAT, 'LaborRequisitions', 'requisition_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'requisition_id' => 'Requisition',
			'type' => 'Type',
			'skill' => 'Skill',
			'count' => 'Count',
			'date_from' => 'Date From',
			'date_to' => 'Date To',
			'status' => 'Status',
			'remarks' => 'Remarks',
			'person_id' => 'Person',
			'person' => 'Person',
			'close_date' => 'Close Date',
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
		$criteria->compare('requisition_id',$this->requisition_id);
		$criteria->compare('type',$this->type);
		$criteria->compare('skill',$this->skill,true);
		$criteria->compare('count',$this->count);
		$criteria->compare('date_from',$this->date_from,true);
		$criteria->compare('date_to',$this->date_to,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('remarks',$this->remarks,true);
		$criteria->compare('person_id',$this->person_id);
		$criteria->compare('person',$this->person,true);
		$criteria->compare('close_date',$this->close_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ClientCompanyRequisitionDetails the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
