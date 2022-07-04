<?php

namespace BigCommerce\ApiV3\ResponseModels\Product;

use BigCommerce\ApiV3\ResourceModels\Catalog\Product\ProductsChannelAssignement;
use BigCommerce\ApiV3\ResponseModels\PaginatedBatchableResponse;

class ProductsChannelAssignementsResponse extends PaginatedBatchableResponse
{
    /**
     * @return ProductsChannelAssignement[]
     */
    public function getProductsChannelAssignements(): array
    {
        return $this->getData();
    }

    protected function resourceClass(): string
    {
        return ProductsChannelAssignement::class;
    }
}
