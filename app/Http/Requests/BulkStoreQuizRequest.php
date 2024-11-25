<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Invoice;

class BulkStoreQuizRequest extends FormRequest
{
    // protected array $data;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
      //  $user = $this->user();

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *

     */
    public function rules(): array
    {
        return [
            '*.user_id' => ['required', 'integer'],
            '*.created_date' => ['required', 'date_format:Y-m-d H:i:s'],
            '*.category' => ['required'],
            '*.slug' => ['required', 'date_format:Y-m-d H:i:s'],
            '*.featured' => ['boolean', 'nullable'],
        ];
    }
    protected function prepareForValidation()
    {
        $data = [];

       foreach($this->toArray() as $obj) {
            // dd($obj);
            $obj['user_id'] = $obj['customerId'] ?? null;
            $obj['created_date'] = $obj['createdDate'] ?? null;
            //   array_merge($data, $obj);
        }

        $this->merge($data);
    }
}
