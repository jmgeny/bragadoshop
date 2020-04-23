<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Category;
use App\Producto;

class DatosInicialesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //User admin
    	//busco si ya se encuentra en la base
    	$useradmin = User::where('email','admin@admin.com')->first();
    	if ($useradmin) {
    		$useradmin->delete();
    	}
    	$useradmin = User::create([
			'name' => 'admin',
	        'email' => 'admin@admin.com',
	        'password' => Hash::make('admin')
    	]);
    }
}
