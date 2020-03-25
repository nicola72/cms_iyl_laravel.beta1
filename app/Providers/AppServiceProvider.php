<?php

namespace App\Providers;

use App\Model\Module;
use App\Model\ModuleConfig;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Builder;
use mysql_xdevapi\Collection;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Builder::defaultStringLength(191);

        //i moduli presenti
        view()->share('cms_modules',Module::all());

        //la configurazione del sito web
        view()->share('website_config',$this->getWebsiteConfig());
    }

    protected function getWebsiteConfig()
    {
        $websiteModule = Module::where('nome','website')->first();
        $moduleConfigs = ModuleConfig::where('module_id',$websiteModule->id)->get();
        $website_config = [];
        foreach ($moduleConfigs as $config)
        {
            $website_config[$config->nome] = $config->value;
        }
        return collect($website_config);
    }
}
