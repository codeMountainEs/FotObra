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


