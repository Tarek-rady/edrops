<?php

        namespace App\Repositories\Sql;
        use App\Models\Terms;
        use App\Repositories\Contract\TermsRepositoryInterface;
        use Illuminate\Database\Eloquent\Collection;

        class TermsRepository extends BaseRepository implements TermsRepositoryInterface
        {

            public function __construct()
            {

                return $this->model = new Terms();

            }

        }
        