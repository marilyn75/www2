<?php

if (!function_exists('showProfileImage')) {
    function showProfileImage()
    {
        if(!auth()->check()) return null;

        if (auth()->user()->file) {
            return asset('/files/profile/' . auth()->user()->file);
        } else {
            return asset('/images/user-placeholder.png');
        }
    }
}