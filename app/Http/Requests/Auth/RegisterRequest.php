<?php

namespace App\Http\Requests\Auth;

use App\Helpers\Enums\RoleType;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
    return [
      'name' => 'required|string',
      'email' => [
        'required', 'email:dns',
        Rule::unique('users', 'email')->ignore($this->user),
      ],
      'password' => 'required|confirmed|min:8',
      'phone' => [
        'required', 'numeric',
        Rule::unique('users', 'phone')->ignore($this->user),
      ],
      'roles' => 'required|' . RoleType::toValidation(1, 2),
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   */
  public function messages(): array
  {
    return [
      '*.required' => ':attribute harus tidak boleh dikosongkan',
      '*.in' => ':attribute harus salah satu dari jenis berikut: :values',
      '*.unique' => ':attribute sudah digunakan, silahkan pilih yang lain',
      '*.exists' => ':attribute tidak ditemukan atau tidak bisa diubah',
      '*.numeric' => ':attribute input tidak valid atau harus berupa angka',
      '*.confirmed' => 'Konfirmasi kolom :attribute tidak cocok',
    ];
  }

  /**
   * Get the validation attribute names that apply to the request.
   *
   * @return array<string, string>
   */
  public function attributes(): array
  {
    return [
      'name' => 'Nama',
      'email' => 'Email',
      'phone' => 'No. Telepon',
      'password' => 'Password',
    ];
  }
}
