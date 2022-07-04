<?php

namespace BigCommerce\ApiV3\Api\Channels;

use BigCommerce\ApiV3\Api\Generic\AttributeFilter;
use BigCommerce\ApiV3\Api\Generic\ResourceWithBatchUpdateApi;
use BigCommerce\ApiV3\Api\Catalog\Products\ProductsSubResourceApi;
use BigCommerce\ApiV3\ResourceModels\Catalog\Product\Product;
use BigCommerce\ApiV3\ResponseModels\Product\ProductResponse;
use BigCommerce\ApiV3\ResponseModels\Product\ProductsChannelAssignementsResponse;
use BigCommerce\ApiV3\Api\Generic\V3ApiBase;
use BigCommerce\ApiV3\Api\Generic\GetAllResources;
use BigCommerce\ApiV3\ResourceModels\Catalog\Product\ProductsChannelAssignement;
use BigCommerce\ApiV3\ResponseModels\PaginatedResponse;
use GuzzleHttp\RequestOptions;
use Psr\Http\Client\ClientExceptionInterface;

class ProductsChannelAssignementsApi extends V3ApiBase
{
    use GetAllResources;

    public const PRODUCTS_CHANNEL_ASSIGNEMENTS  = 'catalog/products/channel-assignments/%d';
    private const PRODUCT_CHANNEL_ASSIGNMENT_ENDPOINT  = 'catalog/products/channel-assignments';

    public const FILTER_IS_FEATURED = 'is_featured';
    public const FILTER_IS_VISIBLE  = 'is_visible';
    public const FILTER_SKU_IS      = 'sku';

    public const FILTER_INCLUDE_FIELDS = 'include_fields';
    public const FILTER_EXCLUDE_FIELDS = 'exclude_fields';

    public const FILTER_INCLUDE     = 'include';
    public const INCLUDE_MODIFIERS = 'modifiers';

    public function getAll(array $filters = [], int $page = 1, int $limit = 250): ProductsChannelAssignementsResponse
    {
        return new ProductsChannelAssignementsResponse($this->getAllResources($filters, $page, $limit));
    }

    protected function multipleResourcesEndpoint(): string
    {
        return self::PRODUCTS_CHANNEL_ASSIGNEMENTS;
    }

    public function create(ProductsChannelAssignement $productChannelAssignment): ProductsChannelAssignementsResponse
    {
      return new ProductsChannelAssignementsResponse($this->createResource($productChannelAssignment));
    }

    public function update(ProductsChannelAssignement $productChannelAssignment): ProductsChannelAssignementsResponse
    {
      return new ProductsChannelAssignementsResponse($this->updateResource($productChannelAssignment));
    }

    /**
     * @param ChannelCurrencyAssignment[] $resources
     * @return ChannelCurrencyAssignmentsResponse
     */
    public function batchCreate(array $resources): PaginatedResponse
    {
      return ProductsChannelAssignementsResponse::buildFromMultipleResponses($this->batchCreateResource($resources));
    }

    /**
     * @param ChannelCurrencyAssignment[] $resources
     * @return ChannelCurrencyAssignmentsResponse
     */
    public function batchUpdate(array $resources): ProductsChannelAssignementsResponse
    {
      return ProductsChannelAssignementsResponse::buildFromMultipleResponses($this->batchUpdateResource($resources));
    }

    /**
     * Currency Assignment endpoints are different, they are all multiple resource endpoints, that may or may not
     * be filtered by channel id.
     *
     * @return string
     */
    public function multipleResourceUrl(): string
    {
        return $this->getParentResourceId() ? $this->singleResourceUrl() : $this->multipleResourcesEndpoint();
    }
    public function singleResourceUrl(): string
    {
        return sprintf(self::PRODUCT_CHANNEL_ASSIGNMENT_ENDPOINT, $this->getParentResourceId());
    }
}

