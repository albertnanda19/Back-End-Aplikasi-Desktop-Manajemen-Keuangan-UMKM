<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Repositories\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->getAllCategories();

        $data = $categories->map(function ($category) {
            return [
                "id" => $category->id,
                "category" => $category->name,
            ];
        });

        return ResponseHelper::createResponse(
            200,
            "Berhasil mendapatkan data kategori",
            $data
        );
    }
}
