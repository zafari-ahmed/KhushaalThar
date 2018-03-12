<?php

/**
 * This is the model class for table "client_companies".
 *
 * The followings are the available columns in table 'client_companies':
 * @property integer $id
 * @property string $company_name
 * @property string $company_email
 * @property integer $allied_to
 * @property string $client_code
 * @property string $password
 * @property string $code_format
 * @property integer $status
 * @property string $createdOn
 *
 * The followings are the available model relations:
 * @property ClientCompanyRequisitions[] $clientCompanyRequisitions
 */
class ClientCompaniesLive extends MyActiveRecord
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
		return 'client_companies';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company_name,code_format, status, createdOn', 'required'),
			array('allied_to, status', 'numerical', 'integerOnly'=>true),
			array('company_name, company_email, client_code, password, code_format', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, company_name, company_email, allied_to, client_code, password, code_format, status, createdOn', 'safe', 'on'=>'search'),
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
			//'companyDeoses' => array(self::HAS_MANY, 'CompanyDeos', 'company_id'),
			'companyRequisitions' => array(self::HAS_MANY, 'ClientCompanyRequisitions', 'company_id'),
			'companypersons' => array(self::HAS_MANY, 'CompanyPersons', 'company_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'company_name' => 'Company Name',
			'company_email' => 'Company Email',
			'allied_to' => 'Allied To',
			'client_code' => 'Client Code',
			'password' => 'Password',
			'code_format' => 'Code Format',
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
		$criteria->compare('company_name',$this->company_name,true);
		$criteria->compare('company_email',$this->company_email,true);
		$criteria->compare('allied_to',$this->allied_to);
		$criteria->compare('client_code',$this->client_code,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('code_format',$this->code_format,true);
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
	 * @return ClientCompanies the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
