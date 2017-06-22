<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Hash;
use App\Models\Settings;
use App\Models\Cate;

class ViewComposerServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//Call function composerSidebar
		$this->composerMenu();	
		
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Composer the sidebar
	 */
	private function composerMenu()
	{
		
		view()->composer( '*' , function( $view ){		
			$banList = $thueList = [];	
			
	        $settingArr = Settings::whereRaw('1')->lists('value', 'name');
	        $cateList = Cate::where('status', 1)->orderBy('display_order', 'asc')->get();	       
			$view->with(['settingArr' => $settingArr, 'cateList' => $cateList]);
			
		});
	}
	
}
