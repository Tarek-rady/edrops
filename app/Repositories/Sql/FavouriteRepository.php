<?php

        namespace App\Repositories\Sql;
        use App\Models\Favourite;
        use App\Repositories\Contract\FavouriteRepositoryInterface;
        use Illuminate\Database\Eloquent\Collection;

        class FavouriteRepository extends BaseRepository implements FavouriteRepositoryInterface
        {

            public function __construct()
            {

                return $this->model = new Favourite();

            }

        }
        