<?php

        namespace App\Repositories\Sql;

use App\Models\Cart;
use App\Models\Item;
        use App\Repositories\Contract\ItemRepositoryInterface;
        use Illuminate\Database\Eloquent\Collection;

        class ItemRepository extends BaseRepository implements ItemRepositoryInterface
        {

            public function __construct()
            {

                return $this->model = new Cart();

            }

        }
