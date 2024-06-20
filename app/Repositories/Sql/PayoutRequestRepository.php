<?php

        namespace App\Repositories\Sql;
        use App\Models\PayoutRequest;
        use App\Repositories\Contract\PayoutRequestRepositoryInterface;
        use Illuminate\Database\Eloquent\Collection;

        class PayoutRequestRepository extends BaseRepository implements PayoutRequestRepositoryInterface
        {

            public function __construct()
            {

                return $this->model = new PayoutRequest();

            }

        }
        