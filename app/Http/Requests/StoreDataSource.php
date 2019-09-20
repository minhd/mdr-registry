<?php

namespace App\Http\Requests;

use App\DataSource;
use Illuminate\Foundation\Http\FormRequest;

class StoreDataSource extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $dataSource = DataSource::find($this->route('datasource'));
        $dataSource = $dataSource ? $dataSource->first() : null;
        return $this->user()
            && ($dataSource ? $this->user()->id === $dataSource->owner->id : true);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required'
        ];
    }
}
