<?php

        namespace App\Repositories\Sql;
        use App\Models\Admin;
        use App\Repositories\Contract\AdminRepositoryInterface;
        use Illuminate\Database\Eloquent\Collection;

        class AdminRepository extends BaseRepository implements AdminRepositoryInterface
        {

            public function __construct()
            {

                return $this->model = new Admin();

            }

        }
        