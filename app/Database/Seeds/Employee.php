<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\Employee as Employee_Model;
class Employee extends Seeder
{
    public function run()
    {
        $model = new Employee_Model;
        $dept = ['Information Technology', 'Marketing', 'Human Resource'];
        $pos = ['Information Technology'=>['Wev Developer', 'Project Manager', 'PHP Developer', 'Full Stack Developer'], 'Marketing' =>['Staff','Clerk','Digitar Designer'], 'Human Resource'=>['Manager', 'Staff', 'Clerk']];
        for($i=0; $i < 25;$i++){
            $faker = \Faker\Factory::create();
            $department = $dept[ceil(rand(0,2))];
            $position = $pos[$department][ceil(rand(0,2))];
            $model->save([
                'company_code'=>"100".$i,
                'first_name'=>$faker->firstName,
                'middle_name'=>$faker->lastName,
                'last_name'=>$faker->lastName,
                'department'=>$department,
                'position'=>$position,
            ]);
        }
    }
}
