<?php

        namespace App\Repositories\Sql;
        use App\Models\Currency;
        use App\Repositories\Contract\CurrencyRepositoryInterface;
        use Illuminate\Database\Eloquent\Collection;

        class CurrencyRepository extends BaseRepository implements CurrencyRepositoryInterface
        {

            public function __construct()
            {

                return $this->model = new Currency();

            }

        }
        