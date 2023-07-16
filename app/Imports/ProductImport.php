<?php

namespace App\Imports;

use App\Constants;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, WithUpserts, ShouldQueue, WithValidation
{
    private $categories;
    public function __construct()
    {
        $this->categories = Category::pluck('id', 'name');
        // se obtiene como una lista clave valor, busca ese id
        //  a que name pertenece en categories y pone dicho valor
    }
    public function model(array $row)
    {
        return new Product([
            'id' => $row['id'],
            'title' => $row['title'],
            'description' => $row['description'],
            'stock' => $row['stock'],
            'status' => $row['status'],
            // aqui va a comparar la categoria 
            'category_id' => $this->categories[$row['category']],
            'price' => $row['price'],
        ]);
    }

    public function uniqueBy(): string|array
    {
        // es definido gracias al WithUpserts:Este trait se utiliza para habilitar
        //   la funcionalidad de actualización  durante la importación de datos.
        return 'id';
    }
    public function batchSize(): int
    {
        return 1000;
    }
    public function chunkSize(): int
    {
        return 1000;
    }
    public function rules(): array
    {
        // '*.  este simbolo es para decir que busque en todas las filas
        return [
            '*.title' => ['required', 'string', 'max:200'],
            '*.description' => ['required', 'string'],
            '*.status' => ['required', 'in:' . implode(',', Constants::getProductStatusOptions())],
            '*.category' => ['required', 'exists:categories,name'],
            '*.stock' => ['required', 'int', 'min:1', 'max:9999'],
            '*.price' => ['required', 'int', 'min:1000', 'max:1000000'],

        ];
    }
}
