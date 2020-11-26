<?php 

namespace Zareismail\NovaContracts\Concerns;

use Illuminate\Http\Request;
use Laravel\Nova\Resource;
use Laravel\Nova\Nova;

trait ShareableResource
{   
    /**
     * Create a new Eloquent Collection instance.
     *
     * @param  array  $models
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function newCollection(array $models = [])
    {
        return new ShareableCollection($models);
    }  

    /**
     * Determine if the field is required for the given resources.
     * 
     * @param  \Laravel\Nova\Resource $resource 
     * @return boolean             
     */
    public function isAvailableFor($resource)
    {
        return  $this->isRequiredFor($resource) || 
                $this->isExclusiveFor($resource) || 
                $this->isNotExcludedFor($resource) && $this->isNotExclusive();
    } 

    /**
     * Determine if the field is required for the given resources.
     * 
     * @param  \Laravel\Nova\Resource $resource 
     * @return boolean             
     */
    public function isRequiredFor($resource)
    {
        return $this->sharedAs($resource, 'required');   
    }  

    /**
     * Determine if the field is required for the given resources.
     * 
     * @param  \Laravel\Nova\Resource $resource 
     * @return boolean             
     */
    public function isOptionalFor($resource)
    {
        return ! $this->isRequiredFor($required);
    } 

    /**
     * Determine if the field is only available for some resources.
     *  
     * @return boolean             
     */
    public function isExclusive()
    {
        return static::sharedResources(app('request'))->filter([$this, 'isExclusiveFor'])->isNotEmpty(); 
    } 

    /**
     * Determine if the field is available for every resources.
     *  
     * @return boolean             
     */
    public function isNotExclusive()
    {
        return ! $this->isExclusive(); 
    } 

    /**
     * Determine if the field is only available for the given resources.
     * 
     * @param  \Laravel\Nova\Resource $resource 
     * @return boolean             
     */
    public function isExclusiveFor($resource)
    {
        return $this->sharedAs($resource, 'only');
    } 

    /**
     * Determine if the field is excluded for the given resources.
     * 
     * @param  \Laravel\Nova\Resource $resource 
     * @return boolean             
     */
    public function isExcludedFor($resource)
    {
        return $this->sharedAs($resource, 'except');
    }

    /**
     * Determine if the field is not excluded for the given resources.
     * 
     * @param  \Laravel\Nova\Resource $resource 
     * @return boolean             
     */
    public function isNotExcludedFor($resource)
    {
        return ! $this->isExcludedFor($resource);
    }    

    /**
     * Return Nova's resources that this resource shared with it.
     * 
     * @return \Laravel\Nova\ResourceCollection
     */
    public static function sharedResources(Request $request)
    {
        return Nova::authorizedResources($request)->filter(function($resource) { 
            return collect(class_implements($resource::newModel()))->contains(static::sharingContract()); 
        })->values();
    }

    /**
     * Get the sharing contracts interface.
     *  
     * @return string            
     */
    abstract public static function sharingContract(): string; 

    /**
     * Determine share condition.
     * 
     * @param  \Laravel\Nova\Resource $resource
     * @param  string $condition 
     * @return bool            
     */
    abstract public function sharedAs($resource, string $condition): bool; 
}