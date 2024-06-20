<?php

        namespace App\Repositories\Sql;
        use App\Models\City;
        use App\Repositories\Contract\CityRepositoryInterface;
        use Illuminate\Database\Eloquent\Collection;

        class CityRepository extends BaseRepository implements CityRepositoryInterface
        {

            public function __construct()
            {

                return $this->model = new City();

            }

        }
        