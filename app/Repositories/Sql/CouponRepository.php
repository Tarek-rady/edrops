<?php

        namespace App\Repositories\Sql;
        use App\Models\Coupon;
        use App\Repositories\Contract\CouponRepositoryInterface;
        use Illuminate\Database\Eloquent\Collection;

        class CouponRepository extends BaseRepository implements CouponRepositoryInterface
        {

            public function __construct()
            {

                return $this->model = new Coupon();

            }

        }
        