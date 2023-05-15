<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Support\Str;


class MainRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * get last path in url eg: domain.com/123/getLastPath
     */
    public function getLastSegment(int $count = 0) : string
    {
        return $this->segment(count($this->segments()) - $count);
    }

    /**
     * eg. domain.com/create === true
     */
    public function isCreate() : bool
    {
        return $this->getLastSegment() === 'create';
    }

    /**
     * eg. domain.com/update/1 === true
     */
    public function isUpdate() : bool
    {
        return Str::contains($this->getLastSegment(1), 'update');
    }

    /**
     * eg. domain.com/delete/1 === true
     */
    public function isDelete() : bool
    {
        return Str::contains($this->getLastSegment(1), 'delete');
    }

    protected function failedValidation(Validator $validator)
    {
        if ($this->header('Is-API') === 'True') {
            throw new HttpResponseException(response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY));
        }

        parent::failedValidation($validator);
    }
}
