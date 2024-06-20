<?php

        namespace App\Repositories\Sql;
        use App\Models\UserCoupon;
        use App\Repositories\Contract\UserCouponRepositoryInterface;
        use Illuminate\Database\Eloquent\Collection;

        class UserCouponRepository extends BaseRepository implements UserCouponRepositoryInterface
        {

            public function __construct()
            {

                return $this->model = new UserCoupon();

            }

        }
        