<?php

namespace App\DTO;

use Illuminate\Foundation\Http\FormRequest;
use Spatie\DataTransferObject\DataTransferObject;

class UserDTO extends DataTransferObject
{
    public ?int $id;

    public string $name;

    public string $email;

    public ?string $password;

    public ?array $abilities;

    public static function fromRequest(FormRequest $request): self
    {
        $data = [
            'name' => $request->validated('name'),
            'email' => $request->validated('email'),
            'abilities' => $request->validated('abilities'),
        ];

        if ($user = $request->route('user')) {
            $data['id'] = $user->id;
        }

        if ($password = $request->validated('password')) {
            $data['password'] = $password;
        }

        return new self($data);
    }

    /**
     * @return array<string, int|string|bool>
     */
    public function getAttributes(): array
    {
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'abilities' => $this->abilities,
        ];

        if ($this->id == null) {
            $data['password'] = $this->password;
        }
        if ($this->password !== null) {
            $data['password'] = $this->password;
        }

        return $data;
    }
}
