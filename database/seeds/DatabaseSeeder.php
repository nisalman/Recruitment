<?php

use Illuminate\Database\Seeder;

use App\{Role, Permission, User, District};
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('sports')->insert([
            ['name' => 'ক্রিকেট '],
            ['name' => 'ফুটবাল'],
            ['name' => 'হকি'],
            ['name' => 'সাঁতার '], 
            ['name' => 'অ্যাথলেটিক্স'],
        ]);

        DB::table('designations')->insert([
            ['name' => 'জেলা প্রশাসক '],
            ['name' => 'সচিব'],
            ['name' => 'সহকারী সচিব'],
        ]);


        DB::table('federations')->insert([
            ['name' => 'ক্রিকেট ফেডারেশন', 'sport_id' => 1],
            ['name' => 'ফুটবাল  ফেডারেশন',  'sport_id' => 2],
            ['name' => 'হকি  ফেডারেশন',  'sport_id' => 3],
            ['name' => 'সাঁতার  ফেডারেশন',  'sport_id' => 4],
        ]);


    	$owner = new Role();
		$owner->name         = 'dev';
		$owner->display_name = 'Developer'; // optional
		$owner->save();

        $dc = new User();
        $dc->name = "Alim";
        $dc->mobile = "111";
        $dc->type = "1";
        $dc->password = bcrypt('123456');
        $dc->save();
        $dc->attachRole($owner);


		$admin = new Role();
		$admin->name         = 'dc';
		$admin->display_name = 'DC Office'; // optional
		$admin->save();

		foreach (District::all() as $district) {	
			$dc = new User();
	        $dc->name = "DC ".$district->getOriginal('name');
	        $dc->username = "DC_".$district->id;
	        $dc->type = "1";
	        $dc->password = bcrypt('123456');
	        $dc->locationable_type = 'App\District';
	        $dc->locationable_id = $district->id;
	        $dc->save();
	        $dc->attachRole($admin);
		}



		$admin = new Role();
		$admin->name         = 'nsc';
		$admin->display_name = 'NSC'; // optional
		$admin->save();


        $dc = new User();
        $dc->name = "NSC";
        $dc->username = "nsc";
        $dc->type = "1";
        $dc->password = bcrypt('123456');
        $dc->save();
        $dc->attachRole($admin);


		$admin = new Role();
		$admin->name         = 'ministry';
		$admin->display_name = 'Ministry'; // optional
		$admin->save();

        $dc = new User();
        $dc->name = "Ministry";
        $dc->username = "ministry";
        $dc->type = "1";
        $dc->password = bcrypt('123456');
        $dc->save();
        $dc->attachRole($admin);

		$admin = new Role();
		$admin->name         = 'bsc';
		$admin->display_name = 'BSC'; // optional
		$admin->save();

        $dc = new User();
        $dc->name = "BSC";
        $dc->username = "bsc";
        $dc->type = "1";
        $dc->password = bcrypt('123456');
        $dc->save();
        $dc->attachRole($admin);

		$createPost = new Permission();
		$createPost->name         = 'forward';
		$createPost->display_name = 'Forward'; // optional
		$createPost->save();
		
		$createPost = new Permission();
		$createPost->name         = 'update';
		$createPost->display_name = 'Update'; // optional
		$createPost->save();

		$createPost = new Permission();
		$createPost->name         = 'alter';
		$createPost->display_name = 'Modify Form'; // optional
		$createPost->save();

		$createPost = new Permission();
		$createPost->name         = 'priority';
		$createPost->display_name = 'Form Priority'; // optional
		$createPost->save();

		$createPost = new Permission();
		$createPost->name         = 'manage-users';
		$createPost->display_name = 'Manage Users'; // optional
		$createPost->save();
    }
}
