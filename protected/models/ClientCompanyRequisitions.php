<?php

/**
 * This is the model class for table "client_company_requisitions".
 *
 * The followings are the available columns in table 'client_company_requisitions':
 * @property integer $id
 * @property integer $company_id
 * @property integer $person_id
 * @property string $requisition_code
 * @property integer $status
 * @property string $createdOn
 *
 * The followings are the available model relations:
 * @property ClientCompanyRequisitionDetails[] $clientCompanyRequisitionDetails
 * @property ClientCompanies $company
 */
class ClientCompanyRequisitions extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'client_company_requisitions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company_id, person_id, requisition_code, status, createdOn', 'required'),
			array('company_id, person_id, status', 'numerical', 'integerOnly'=>true),
			array('requisition_code', 'unique'),
			array('requisition_code', 'length', 'max'=>255),
			//array('requisition_code','unique'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, company_id, person_id, requisition_code, status, createdOn', 'safe', 'on'=>'search'),
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
			'clientCompanyRequisitionDetails' => array(self::HAS_MANY, 'ClientCompanyRequisitionDetails', 'requisition_id'),
			
			'company' => array(self::BELONGS_TO, 'ClientCompanies', 'company_id'),
			'person' => array(self::BELONGS_TO, 'CompanyPersons', 'person_id'),
			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'company_id' => 'Company',
			'person_id' => 'Person',
			'requisition_code' => 'Requisition Code',
			'status' => 'Status',
			'createdOn' => 'Created On',
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
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('person_id',$this->person_id);
		$criteria->compare('requisition_code',$this->requisition_code,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('createdOn',$this->createdOn,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ClientCompanyRequisitions the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
