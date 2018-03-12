<?php

/**
 * This is the model class for table "labours".
 *
 * The followings are the available columns in table 'labours':
 * @property integer $id
 * @property string $full_name
 * @property string $father_name
 * @property integer $nicop
 * @property string $cnic
 * @property string $religion
 * @property string $dob
 * @property string $gender
 * @property string $mobile_number
 * @property integer $martial_status
 * @property integer $kids
 * @property integer $block_2
 * @property integer $village_id
 * @property string $address
 * @property integer $tehsil_id
 * @property integer $district_id
 * @property integer $category_id
 * @property string $designation
 * @property string $remarks
 * @property string $thumb
 * @property string $avatar
 * @property integer $drive
 * @property integer $deo_id
 * @property integer $status
 * @property string $createdOn
 *
 * The followings are the available model relations:
 * @property LaborRequisitions[] $laborRequisitions
 */
class Labours extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'labours';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('full_name, father_name, nicop, cnic, religion, dob, gender, mobile_number, martial_status, block_2, village_id, tehsil_id, district_id, category_id, designation, drive, deo_id, status, createdOn', 'required'),
			array('nicop, martial_status, kids, block_2, village_id, tehsil_id, district_id, category_id, drive, deo_id, status', 'numerical', 'integerOnly'=>true),
			array('full_name, father_name, cnic, religion, gender, mobile_number, address, designation', 'length', 'max'=>255),
			
			array('cnic','unique'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, full_name, father_name, nicop, cnic, religion, dob, gender, mobile_number, martial_status, kids, block_2, village_id, address, tehsil_id, district_id, category_id, designation, remarks, thumb, avatar, drive, deo_id, status, createdOn', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		//array('cnic','unique'),
		//array('mobile_number','unique'),
		return array(
			'village' => array(self::BELONGS_TO, 'Villages', 'village_id'),
			'tehsil' => array(self::BELONGS_TO, 'Tehsil', 'tehsil_id'),
			'district' => array(self::BELONGS_TO, 'Districts', 'district_id'),

			'drivingLicense' => array(self::HAS_MANY, 'LabourDrivingLicenses', 'labour_id'),
			'employments' => array(self::HAS_MANY, 'LabourEmployments', 'labour_id'),
			'educations' => array(self::HAS_MANY, 'LabourEducations', 'labour_id'),
			'documents' => array(self::HAS_MANY, 'LabourDocuments', 'labour_id'),
			'skill' => array(self::HAS_MANY, 'LabourSkillTest', 'labour_id','order'=>'`date` DESC'),

			'police' => array(self::HAS_MANY, 'LabourPolice', 'labour_id'),
			'hse' => array(self::HAS_MANY, 'LabourHse', 'labour_id'),
			'medical' => array(self::HAS_MANY, 'LabourMedical', 'labour_id'),
			'traings' => array(self::HAS_MANY, 'LabourTraings', 'labour_id'),

			'traingsActive' => array(self::HAS_MANY, 'LabourTraings', 'labour_id','condition' => "`status` = 0"),
			//'traingsClose' => array(self::HAS_MANY, 'LabourTraings', 'labour_id','condition' => "`status` = 1"),

			'laborRequisitions' => array(self::HAS_MANY, 'LaborRequisitions', 'labour_id'),
			'laborRequisitionsActive' => array(self::HAS_MANY, 'LaborRequisitions', 'labour_id','condition' => "`status` = 1 OR `status` = 0"),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'full_name' => 'Full Name',
			'father_name' => 'Father Name',
			'nicop' => 'Nicop',
			'cnic' => 'Cnic',
			'religion' => 'Religion',
			'dob' => 'Dob',
			'gender' => 'Gender',
			'mobile_number' => 'Mobile Number',
			'martial_status' => 'Martial Status',
			'kids' => 'Kids',
			'block_2' => 'Block 2',
			'village_id' => 'Village',
			'address' => 'Address',
			'tehsil_id' => 'Tehsil',
			'district_id' => 'District',
			'category_id' => 'Category',
			'designation' => 'Designation',
			'remarks' => 'Remarks',
			'thumb' => 'Thumb',
			'avatar' => 'Avatar',
			'drive' => 'Drive',
			'deo_id' => 'Deo',
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
		$criteria->compare('full_name',$this->full_name,true);
		$criteria->compare('father_name',$this->father_name,true);
		$criteria->compare('nicop',$this->nicop);
		$criteria->compare('cnic',$this->cnic,true);
		$criteria->compare('religion',$this->religion,true);
		$criteria->compare('dob',$this->dob,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('mobile_number',$this->mobile_number,true);
		$criteria->compare('martial_status',$this->martial_status);
		$criteria->compare('kids',$this->kids);
		$criteria->compare('block_2',$this->block_2);
		$criteria->compare('village_id',$this->village_id);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('tehsil_id',$this->tehsil_id);
		$criteria->compare('district_id',$this->district_id);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('designation',$this->designation,true);
		$criteria->compare('remarks',$this->remarks,true);
		$criteria->compare('thumb',$this->thumb,true);
		$criteria->compare('avatar',$this->avatar,true);
		$criteria->compare('drive',$this->drive);
		$criteria->compare('deo_id',$this->deo_id);
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
	 * @return Labours the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
