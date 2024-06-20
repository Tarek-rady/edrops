<?php





namespace App\Http\Controllers\Api\Traits;


trait GetRoleStocks
{

    function getStocks(){
        $admin = auth('admin')->user();
        $stocks = [];

        foreach($admin->roles as $role) {
            $role_stocks = $role->stocks;

            foreach ($role_stocks as $role_stock) {
                $stocks[] = $role_stock->id;
            }
        }
        return $unique_stocks = array_unique($stocks);
    }

}


