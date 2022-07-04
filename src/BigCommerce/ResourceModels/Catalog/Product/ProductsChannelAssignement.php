<?php

namespace BigCommerce\ApiV3\ResourceModels\Catalog\Product;

use BigCommerce\ApiV3\ResourceModels\HasCustomUrl;
use BigCommerce\ApiV3\ResourceModels\ResourceModel;
use stdClass;

class ProductsChannelAssignement extends ResourceModel
{
    public int $channel_id;
    public string $product_id;
}
