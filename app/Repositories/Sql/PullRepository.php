<?php

        namespace App\Repositories\Sql;
        use App\Models\Pull;
        use App\Repositories\Contract\PullRepositoryInterface;
        use Illuminate\Database\Eloquent\Collection;

        class PullRepository extends BaseRepository implements PullRepositoryInterface
        {

            public function __construct()
            {

                return $this->model = new Pull();

            }

        }
        