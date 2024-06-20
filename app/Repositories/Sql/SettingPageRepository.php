<?php

        namespace App\Repositories\Sql;

use App\Models\Setting;
use App\Models\SettingPage;
        use App\Repositories\Contract\SettingPageRepositoryInterface;
        use Illuminate\Database\Eloquent\Collection;

        class SettingPageRepository extends BaseRepository implements SettingPageRepositoryInterface
        {

            public function __construct()
            {

                return $this->model = new Setting();

            }

        }
