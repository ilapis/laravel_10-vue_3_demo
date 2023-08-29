<?php

namespace App\Data;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Http\Request;
use JsonSerializable;

abstract class BaseData implements Arrayable, Jsonable, JsonSerializable
{
    /**
     * @param  array<string, string>  $data
     */
    public function __construct(Request $request = null, array $data = [])
    {
        $source = [];
        if ($request !== null) {
            $source = $request->all();
        } elseif (! empty($data)) {
            $source = $data;
        } else {
            throw new \InvalidArgumentException(
                'Constructor expects an instance of Illuminate\Http\Request or an associative array.'
            );
        }

        $this->fillProperties($source);
    }

    /**
     * @param array<string, string>$data
     */
    protected function fillProperties(array $data): void
    {
        $properties = get_class_vars(static::class);

        foreach ($properties as $property => $value) {
            if (array_key_exists($property, $data)) {
                $this->{$property} = $data[$property];
            } else {
                if (! isset($this->{$property})) {
                    unset($this->{$property});
                }
            }
        }
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
}
