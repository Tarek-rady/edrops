<?php

        namespace App\Repositories\Sql;
        use App\Models\Stock;
        use App\Repositories\Contract\StockRepositoryInterface;
        use Illuminate\Database\Eloquent\Collection;

        class StockRepository extends BaseRepository implements StockRepositoryInterface
        {

            public function __construct()
            {

                return $this->model = new Stock();

            }

        }
        