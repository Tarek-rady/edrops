<?php

        namespace App\Repositories\Sql;
        use App\Models\ProfitApp;
        use App\Repositories\Contract\ProfitAppRepositoryInterface;
        use Illuminate\Database\Eloquent\Collection;

        class ProfitAppRepository extends BaseRepository implements ProfitAppRepositoryInterface
        {

            public function __construct()
            {

                return $this->model = new ProfitApp();

            }

        }
        