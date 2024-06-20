<?php

        namespace App\Repositories\Sql;
        use App\Models\Cart;
        use App\Repositories\Contract\CartRepositoryInterface;
        use Illuminate\Database\Eloquent\Collection;

        class CartRepository extends BaseRepository implements CartRepositoryInterface
        {

            public function __construct()
            {

                return $this->model = new Cart();

            }

        }
        