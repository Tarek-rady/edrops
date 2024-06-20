<?php

        namespace App\Repositories\Sql;
        use App\Models\Saller;
        use App\Repositories\Contract\SallerRepositoryInterface;
        use Illuminate\Database\Eloquent\Collection;

        class SallerRepository extends BaseRepository implements SallerRepositoryInterface
        {

            public function __construct()
            {

                return $this->model = new Saller();

            }

        }
        