<?php

namespace App\Http\Requests;

use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Foundation\Http\FormRequest;

class ResizeImageRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            //implenetasikan validasi resize
            'image' => ['required'],
            'w' => ['required', 'regex:/^\d+(\.\d+)?%?/'], //10", "3.14", "50%", "0.5%"
            'h' =>  'regex:/^\d+(\.\d+)?%?/',
            'album_id' => 'exists:Album,id'
        ];

        $image = $this->all()['image'] ?? false;
        if($image && $image instanceof UploadedFile){
            $rules['image'][] = 'image';
        } else {
            $rules['image'][]='url';
        }

        return $rules;
    }
}
