<?php

if (! function_exists('active')) {

    /**
     * Add active class to navigation links
     * 
     * @param  string $routeName
     * @param  string $className
     * @return string
     */
    function active(string $routeName, string $className = 'active'): string
    {
        return (Route::current()->getName() === $routeName) ? $className : '';
    }

}
