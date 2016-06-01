<?php 

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {


	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'App\Repositories\CategoryRepository',
			'App\Repositories\CategoryRepositoryEloquent'
			);

		$this->app->bind(
			'App\Repositories\ProductRepository',
			'App\Repositories\ProductRepositoryEloquent'
			);

		$this->app->bind(
			'App\Repositories\ClientRepository',
			'App\Repositories\ClientRepositoryEloquent'
			);

		$this->app->bind(
			'App\Repositories\UserRepository',
			'App\Repositories\UserRepositoryEloquent'
			);
		$this->app->bind(
			'App\Repositories\OrderRepository',
			'App\Repositories\OrderRepositoryEloquent'
			);
		$this->app->bind(
			'App\Repositories\OrderItemRepository',
			'App\Repositories\OrderItemRepositoryEloquent'
			);
		$this->app->bind(
			'App\Repositories\CupomRepository',
			'App\Repositories\CupomRepositoryEloquent'
			);
	}

}
