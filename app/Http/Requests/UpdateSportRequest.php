<?php

namespace App\Http\Requests;

use App\Sport;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateSportRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('sport_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'name' => [
                'required'],
        ];

    }
}
