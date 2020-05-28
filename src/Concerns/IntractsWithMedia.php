<?php 

namespace Zareismail\NovaContracts\Concerns;

use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Support\Collection;
use Spatie\Image\Manipulations;

trait IntractsWithMedia
{ 
	use HasMediaTrait;

	// protected $medias = [
 //        'image' => [
 //            'multiple' => true,
 //            'disk'  => 'armin.image',
 //            'schemas' => [
 //                'residence', 'residence.list', '*'
 //            ]
 //        ],
	// ];

    public function registerMediaCollections()
    {
    	Collection::make($this->medias)->each(function($config, $name) { 
            tap($this->addMediaCollection($name), function($collection) use ($config) {
                $collection->useDisk($config['disk'] ?? 'armin.file');
                $collection->useFallbackUrl(schema_placeholder('main'));

                if(! isset($config['multiple']) || $config['multiple'] === false) {
                    $collection->singleFile();
                }

                $collection->registerMediaConversions(function(Media $media) use ($config) {
                    $this->schemas($config['schemas'] ?? '*')->each([
                        $this, 'registerSchemaConversion'
                    ]); 
                });
            });  
    	});
    } 

    public function registerSchemaConversion($schema, $name)
    {      
		$conversion = $this
						->addMediaConversion($name)
						->format($schema['extension'] ?? Manipulations::FORMAT_JPG)
						->width($schema['width'] ?? 0)
						->height($schema['height'] ?? 0)
						->quality(100 - ($schema['compress'] ?? 0))
                        ->background($schema['background'] ?? 'fff')
                        ->extractVideoFrameAtSecond(1);

		if($schema['resize'] === 'crop') { 
			$conversion->fit(
                Manipulations::FIT_FILL, $schema['width'] ?? 0, $schema['height'] ?? 0
            );
		}    
    } 

    /**
     * Get curent schema configurations
     * 
     * @return \Illuminate\Support\Collection
     */
    public function schemas($schemas)
    {  
        $filterCallback = function($schema, $name) use ($schemas) {  
            $schemas = Collection::make($schemas)->flip();

            return $schemas->search($name) || $schemas->has($schema['group'] ?? '*');
        };

        return app('armin.imager.schema')->all()->filter($filterCallback); 
    }  

    /**
     * Retrive conversions of an media
     * 
     * @param \Spatie\MediaLibrary\Models\Media $media      
     * @param  array $conversions
     * @return \Illuminate\Support\Collection             
     */
    public function getConversions(Media $media = null, array $conversions)
    { 
        $conversions = array_combine($conversions, $conversions);

        return collect($conversions)->map(function($conversion) use ($media) { 
            if(optional($media)->hasGeneratedConversion($conversion)) {
                return $media->getFullUrl($conversion);
            }

            return schema_placeholder($conversion); 
        });
    }
}