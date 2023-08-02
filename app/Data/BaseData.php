<?php

namespace App\Data;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use JsonSerializable;

abstract class BaseData implements Arrayable, Jsonable, JsonSerializable
{
    public function __construct(private Request $request)
    {
        $data = $this->request->all();

        $this->validate($data);

        $properties = get_class_vars(static::class);

        foreach ($properties as $property => $value) {
            if (array_key_exists($property, $data)) {
                $this->{$property} = $data[$property];
            } else {
                if ($this->{$property} === null) {
                    unset($this->{$property});
                }
            }
        }
    }

    /**
     * @return array<string, mixed>
     */
    protected function rules(): array
    {
        return [];
    }

    public function authorize(string $ability, mixed $model): static//: self|JsonResponse
    {
        $user = $this->request->user();

        if ($user === null || ! $user->can($ability, $model)) {

            throw new AuthorizationException();
        }

        return $this;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public function toJson($options = 0): string
    {
        $json = json_encode($this->jsonSerialize(), $options);
        if ($json === false) {
            throw new \RuntimeException('JSON encoding failed');
        }

        return $json;
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * @param array<string, mixed> $data
     */
    protected function validate(array $data = []): void
    {
        $validator = Validator::make(empty($data) ? $this->toArray() : $data, $this->rules());

        if ($validator->fails()) {
            $response = response()->json([
                'errors' => $validator->errors(),
            ], 422);

            throw new ValidationException($validator, $response);
        }
    }
}
