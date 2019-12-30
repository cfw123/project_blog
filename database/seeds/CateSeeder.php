<?php

use Illuminate\Database\Seeder;

class CateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [];
        for($i=1;$i<6;$i++)
        {
            $tmp=[];
            $tmp['name']=str_random(4);
            $tmp['pid']=0;
            $tmp['path']=0;
            $tmp['created_at']=date('Y-m-d H:i:s');
            $tmp['updated_at']=date('Y-m-d H:i:s');
            $arr[]=$tmp;
        }
        DB::table('cates')->insert($arr);
    }
}
