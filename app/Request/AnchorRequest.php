<?php
/**
 * Created by PhpStorm.
 * User: shuyu
 * Date: 2019/10/28
 * Time: 10:36
 */

namespace App\Request;


use Hyperf\Validation\Request\FormRequest;

class AnchorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name'           => 'required',
            'wechat'         => 'required',
            'head_images'    => 'required',
            //'sex'            => 'required',
            //'mobile_phone'   => 'required',
            //'work_desc'      => 'required',
            //'fans_num'       => 'required',
            //'height'         => 'required',
            //'platform'       => 'required',
            //'work_type'      => 'required',
            'cover_image'    => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'name is required.',
            'wechat.required'=> 'wechat is required.',
            'head_images.required'=> 'head_images is required.',
            'cover_image.required'=> 'cover_image is required.',
        ];
    }
}