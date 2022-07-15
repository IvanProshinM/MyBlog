<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * @property int $id;
 * @property int $patient_id;
 * @property int $doctor_id;
 * @property int $status_id;
 * @property float $temperature;
 * @property string $symptoms;
 * @property string $home_coordinate;
 * @property int $discharged_at;
 * @property int $doctor_attempted_at;
 * @property int $created_at;
 * @property int $updated_at;
 *
 *
 */
class Order extends ActiveRecord
{
    public const STATUS_NEW = 0;

    public const STATUS_TREATMENT = 1;

    public const STATUS_DISCHARGED = 2;


    public static function tableName()
    {
        return "order";
    }

    public function rules()
    {
        return [
            [['id', 'patient_id', 'doctor_id', 'status_id', 'discharged_at', 'doctor_attempted_at', 'created_at', 'updated_at'], 'integer'],
            [['symptoms', 'home_coordinate'], 'string'],
            ['temperature', 'number']
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class
        ];

    }

    public function getCoordinate()
    {
        if ($this->home_coordinate === null) {
            return null;
        }

        $coordinates = unpack(
            'x/x/x/x/corder/Ltype/dlat/dlon',
            $this->home_coordinate
        );

        return [
            'latitude' => $coordinates['lat'],
            'longitude' => $coordinates['lon'],
        ];
    }


}