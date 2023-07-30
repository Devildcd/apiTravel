<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use App\Http\Validators\PersonalValidations;

class Travel extends Model
{
    

    protected $fillable = [
        'flyType',
        'class',
        'passengers',
        'origin',
        'dateOrigin',
        'destiny',
        'dateDestiny'
    ];

   
    public static $flyTypeValues = [
        'Solo Ida',
        'Ida y vuelta',
        'Multi-Destino',
    ];
    
    public static $classValues = [
        'Económica',
        'Económica Premium',
        'Negocios',
        'Primera',
    ];
    
    public static $originValues = [
        'Berlin',
        'Paris',
        'Oslo',
        'Estocolmo',
        'Habana',
        'Washington',
        'Moscow',
        'Budapest',
        'Londres',
        'Madrid',
    ];
    
    public static $destinyValues = [
        'Berlin',
        'Paris',
        'Oslo',
        'Estocolmo',
        'Habana',
        'Washingtown',
        'Moscow',
        'Budapest',
        'Londres',
        'Madrid',
    ];

    public static function rules() {

        return [
            'flyType' => [
                'required',
                Rule::in(self::$flyTypeValues),
            ],
            'class' => [
                'required',
                Rule::in(self::$classValues),
            ],
            'passengers' => [
                'required',
                'numeric',
                'min:1',
                
            ],
            'origin' => [
                'required',
                Rule::in(self::$originValues),
            ],
            'dateOrigin' => [
                'required',
                'date',
            ],
            'destiny' => [
                'required',
                Rule::in(self::$destinyValues),
            ],
            'dateDestiny' => [
            Rule::requiredIf(function () {
                return request()-> input('flyType') === 'Ida y vuelta';
            }),
            
            'nullable',
            'date',
            'after:dateOrigin',
             function ($attribute, $value, $fail) {
                if (!Travel::validateDateDestiny(request()->input('flyType'), $value)) {
                    $fail('La fechaDestiny debe ser null cuando flyType es Solo Ida.');
                }
             },
         ],
        ];
    }

        /**
     * Función para validar que si flyType = 'Solo Ida', la fechaDestiny sea null.
     *
     * @param string $flyType
     * @param mixed $fechaDestiny
     * @return bool
     */
    public static function validateDateDestiny(string $flyType, $fechaDestiny): bool
    {
        if ($flyType === 'Solo Ida' && $fechaDestiny !== null) {
            return false;
        }

        return true;
    }

    
    //Function para filtrar los datos
    public static function filtrar($flyType = null, $class = null, $passengers = null, $origin = null, $dateOrigin = null, $destiny = null, $dateDestiny) {
    
        $query = self::query();

        if($flyType) {
            $query-> where('flyType', $flyType);
        }

        if($class) {
            $query-> where('class', $class);
        }

        if($passengers) {
            $query-> where('passengers', $passengers);
        }

        if($origin) {
            $query-> where('origin', $origin);
        }

        if($dateOrigin) {
            $query-> where('dateOrigin', $dateOrigin);
        }

        if($destiny) {
            $query-> where('destiny', $destiny);
        }

        if($dateDestiny) {
            $query-> where('dateDestiny', $dateDestiny);
        }
        
        return $query->get();
    }    

}
