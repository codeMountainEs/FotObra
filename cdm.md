# laravel 
# filamentphp 

# SPATIE
https://filamentphp.com/plugins/filament-spatie-media-library#installation

composer require filament/spatie-laravel-media-library-plugin:"^3.2" -W


php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="medialibrary-migrations"

php artisan migrate 

# Modelos 

Obra , fotos, media 
factory 

# filament resource 

# filament relation-manager
php artisan make:filament-relation-manager ObraResource fotos nombre



## multitenant .. laraveldaily.com/post/multi-tenancy-filament-simple 

trait multientantable , model/trait/multitenantable.php
con esto cada vez que se cree una foto se la asigna auto al usuario... en cuestion ..

ahora con global scope 


## add roles a users 

https://laraveldaily.com/lesson/laravel-breeze-user-role-areas/role-model-migrations-seeder



php artisan:migration add_role_to_users_table

php artisan make:migration "add role id to users table"



https://laraveldaily.com/post/filament-registration-form-extra-fields-choose-user-role


## obras y usuarios 


php artisan make:migration create_ObraUser


## InfoList de Obra 
composer require filament/infolists:"^3.2" -W



php artisan make:filament-page 
name : ViewObra
Resource ObraResource 



app/Filament/Resources/ObraResource/Pages/ViewObra.php] created successfully.  

## subir fotos .. con Spatie o fileupload .. 
al final con fileupload , ya que spatie, no controlamos carpetas y en plesk no suben carpetas ni ficheros con permisos suficientes y da error 403


## WIDGET 
php artisan make:filament-widget StatsOverview --stats-overview
FotoObrasStatsWidget 
ObraResource
