<?php namespace App\BokaKanot;

use App\BokaKanot\Repositories\CategoryRepository;
use App\BokaKanot\Repositories\CentreRepository;
use App\BokaKanot\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class CentreUtil
{
    /**
     * @var CentreRepository
     */
    private $centreRepository;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;
    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(CentreRepository $centreRepository, CategoryRepository $categoryRepository, ProductRepository $productRepository)
    {
        $this->centreRepository = $centreRepository;
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }
    
    public function getAdminFeeProductId($centreId)
    {
        $categoryId = $this->categoryRepository->getFeeCategory($centreId);

        $productId = $this->productRepository->getAdminProduct($categoryId);

        return $productId;
    }
}
