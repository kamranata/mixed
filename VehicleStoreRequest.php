<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class VehicleStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // $user = User::find($this->route('user'));

        // return $user && $user->can('update', $user);

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'make'             => 'required|array',
            'make.id'          => 'required|integer',
            'model'            => 'required|array',
            'model.id'         => 'required|integer',
            'body_type'        => 'required|array',
            'body_type.id'     => 'required|integer',
            'transmission'     => 'required|array',
            'transmission.id'  => 'required|integer',
            'fuel_type'        => 'required|array',
            'fuel_type.id'     => 'required|integer',
            'engine_volume'    => 'required|array',
            'engine_volume.id' => 'required|integer',
            'engine_power'     => 'required|integer',
            'mileage'          => 'required|integer',
            'mileage_unit'     => 'required|in:km,mi',
            'gear'             => 'sometimes|nullable|array',
            'gear.id'          => 'sometimes|required|integer',
            'color'            => 'required|array',
            'color.id'         => 'required|integer',
            'license_plate'    => 'sometimes|nullable|string',
            'vin'              => 'sometimes|nullable|string',
            'bought_at_year'   => 'sometimes|nullable|integer|min:1900|max:2021',
            'bought_at_month'  => 'sometimes|nullable|integer|min:1|max:12',
            'bought_at_day'    => 'sometimes|nullable|integer|min:1|max:31',
            'manufactured_in'  => 'sometimes|nullable|integer',
            'manufactured_at'  => 'sometimes|nullable|integer|min:1900|max:2021',
        ];
    }

    protected function prepareForValidation()
    {
        $data = [];

        // if ($this->email) {
        //     $data['email'] = strtolower($this->email);
        // }

        if (!empty($data)) {
            $this->merge($data);
        }
    }

    public function validated()
    {
        $validated = $this->validator->validated();

        return $this->sanitize($validated);
    }

    protected function sanitize($validated)
    {
        if (isset($validated['make']['id'])) {
            $validated['make_id'] = $validated['make']['id'];
            unset($validated['make']);
        }

        if (isset($validated['model']['id'])) {
            $validated['model_id'] = $validated['model']['id'];
            unset($validated['model']);
        }

        if (isset($validated['body_type']['id'])) {
            $validated['body_type_id'] = $validated['body_type']['id'];
            unset($validated['body_type']);
        }

        if (isset($validated['transmission']['id'])) {
            $validated['transmission_id'] = $validated['transmission']['id'];
            unset($validated['transmission']);
        }

        if (isset($validated['fuel_type']['id'])) {
            $validated['fuel_type_id'] = $validated['fuel_type']['id'];
            unset($validated['fuel_type']);
        }

        if (isset($validated['engine_volume']['id'])) {
            $validated['engine_volume_id'] = $validated['engine_volume']['id'];
            unset($validated['engine_volume']);
        }

        if (isset($validated['gear']['id'])) {
            $validated['gear_id'] = $validated['gear']['id'];
            unset($validated['gear']);
        }

        if (isset($validated['color']['id'])) {
            $validated['color_id'] = $validated['color']['id'];
            unset($validated['color']);
        }

        if (isset($validated['transmission']['id'])) {
            $validated['transmission_id'] = $validated['transmission']['id'];
            unset($validated['transmission']);
        }

        return $validated;
    }

    // public function messages() { }
}
