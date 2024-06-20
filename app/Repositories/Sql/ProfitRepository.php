<?php

        namespace App\Repositories\Sql;
        use App\Models\Profit;
        use App\Repositories\Contract\ProfitRepositoryInterface;
        use Illuminate\Database\Eloquent\Collection;

        class ProfitRepository extends BaseRepository implements ProfitRepositoryInterface
        {

            public function __construct()
            {

                return $this->model = new Profit();

            }

        }
        