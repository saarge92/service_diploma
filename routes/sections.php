<?php

Route::group(
    ['middleware' => 'roles', 'prefix' => 'admin', 'roles' => ['admin']],
    function () {
        Route::get(
            "/teams",
            [
                'uses' => 'TeamAdminController@getMembersList',
                'as' => 'admin.team.list'
            ]
        );
    }
);

