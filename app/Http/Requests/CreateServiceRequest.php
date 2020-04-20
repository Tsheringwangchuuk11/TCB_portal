<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class CreateServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'cid_no'=>'required|min:11',
            'name'=>'required',
            'name_one'=>'required',
            'name_two'=>'required',
            'proposed_location'=>'required',
            'location_id'=>'required',
            'contact_no'=>'required',
            'tentative_cons'=>'required',
            'tentative_com'=>'required',
            'drawing_date'=>'required',
            'email'=>'required|email',
            'star_category_id'=>'required',
            'license_no'=>'required',
            'license_date'=>'required',
            'owner'=>'required',
            'address'=>'required',
            'fax'=>'required',
            'internet_url'=>'required',
            'bed_no'=>'required',
            'thram_no'=>'required',
            'house_no'=>'required',
            'town_distance'=>'required',
            'road_distance'=>'required',
            'condition'=>'required',
            'validity_date'=>'required',
            'flat_no'=>'required',
            'building_no'=>'required',
            'room_type_id'=>'required',
            'room_no'=>'required',
            'staff_area_id'=>'required',
            'hotel_div_id'=>'required',
            'staff_name'=>'required',
            'staff_gender'=>'required'
        ];
    }
}
