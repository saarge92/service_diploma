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
        Route::get(
            "/teams/create",
            [
                'uses' => 'TeamAdminController@getCreateMemberListPage',
            ]
        );
        Route::post(
            "/teams/create",
            [
                'uses' => 'TeamAdminController@createMemberTeam',
                'as' => 'admin.team.create'
            ]
        );
    }
);

