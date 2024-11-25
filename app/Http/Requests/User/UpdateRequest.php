<?php
namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'password' => 'required|min:5',
            'role' => 'required',
        ];
    }
}
