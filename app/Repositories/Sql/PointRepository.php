<?php

        namespace App\Repositories\Sql;
        use App\Models\Point;
        use App\Repositories\Contract\PointRepositoryInterface;
        use Illuminate\Database\Eloquent\Collection;

        class PointRepository extends BaseRepository implements PointRepositoryInterface
        {

            public function __construct()
            {

                return $this->model = new Point();

            }

        }
        