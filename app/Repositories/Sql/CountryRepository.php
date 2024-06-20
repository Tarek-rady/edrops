<?php

        namespace App\Repositories\Sql;
        use App\Models\Country;
        use App\Repositories\Contract\CountryRepositoryInterface;
        use Illuminate\Database\Eloquent\Collection;

        class CountryRepository extends BaseRepository implements CountryRepositoryInterface
        {

            public function __construct()
            {

                return $this->model = new Country();

            }

        }
        