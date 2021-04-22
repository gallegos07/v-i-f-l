<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class BookFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

  
    public function rules(Request $data)
   {
      $bookId = $data->id;
      return [
         'title' => 'required|max:50|regex:/^[a-zA-ZÀ-ÿ\s\d\.\,]+$/', //funciona
         'author' => 'required|max:50|regex:/^[a-zA-ZÀ-ÿ\s\.\-]+$/',  //funciona
         'isbn' => 'required|digits:13|unique:books,isbn,'.$bookId, //funciona
      ];
   }

   public function messages()
    {
        return [
            'title.required' => 'El campo :attribute es obligatorio.',
            'title.max' => 'El campo:attribute debe contener maximo 50 caracteres.',
            'title.regex' => 'El campo :attribute acepta puntos, comas y espacios.',

            'author.required' => 'El campo :attribute es obligatorio.',
            'author.max' => 'El campo :attribute debe contener maximo 50 caracteres.',
            'author.regex' => 'El campo :attribute acepta puntos, guiones y espacios, no acepta dígitos.',

            'isbn.required' => 'El campo :attribute es obligatorio.',
            'isbn.digits' => 'El campo :attribute debe ser un número de :digits dígitos',
            'isbn.unique' => 'El campo :attribute ya ha sido registrado.',                
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'titulo',
            'isbn' => 'isbn',
            'author' => 'autor',             
        ];
    }
}
