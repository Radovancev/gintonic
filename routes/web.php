<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',
    [
        'uses' => 'HomeController@showIndexPage',
        'as'   => 'home'
    ]
);

Route::get('/gallery',
    [
        'uses' => 'HomeController@showGalleryPage',
        'as'   => 'gallery'
    ]
);

Route::get('/author',
    [
        'uses' => 'HomeController@showAuthorPage',
        'as'   => 'author'
    ]
);




// If user is logged he shouldn't be able to access these routes redirect to home
Route::group(['middleware' => 'RedirectAuthenticated'], function(){

    Route::post('/register', 
        [
            'uses' => 'LoginController@register',
            'as'   => 'register'
        ]
    );

    Route::post('/login', 
        [
            'uses' => 'LoginController@login',
            'as'   => 'login'
        ]
    );

    Route::get('/login',
        [
            'uses' => 'HomeController@showLoginPage',
            'as'   => 'loginForm'
        ]
    );

    Route::get('/register',
        [       
            'uses' => 'HomeController@showRegisterPage',
            'as'   => 'registerForm'
        ]
    );

});




// User should be able to access these routes only if he is logged in if not redirect to home
Route::group(['middleware' => 'RedirectNotAuthenticated'], function(){

    Route::get('/logout', 
        [
            'uses' => 'LoginController@logout',
            'as'   => 'logout'
        ]
    );

    Route::get('poll',
        
        [
            'uses' => 'HomeController@showSurveryPage',
            'as'   => 'poll'
        ]
    );

});



Route::get('/post/{id}',
    [
        'uses' => 'HomeController@showSinglePost',
        'as'   => 'singlePost'
    ]
);

Route::post('ajax/data', 
    [
        'uses' => 'AjaxController@handleRequest'
    ]


);
Route::post('ajax/vote',
    [
        'uses' => 'AjaxController@vote'
    ]
);

//Admin part
Route::group(['middleware' => 'RedirectIfNotAdmin' , 'prefix' => 'dashboard'], function($prefix){
    Route::get('/', 'HomeController@showAdminPanel');

    //Users
    Route::get('/users',
        [
            'uses' => 'Admin\UserController@index',
            'as'   => 'showAllUsers'
        ]
    );

    Route::get('/users/{id}',
        [
            'uses' => 'Admin\UserController@delete',
            'as'   => 'deleteUser'
        ]
    );
    Route::get('/user/create',
        [
            'uses' => 'Admin\UserController@create',
            'as'   => 'createUserForm'
        ]
    );

    Route::post('/user/create',
        [
            'uses' => 'Admin\UserController@store',
            'as'   => 'createUser'
        ]

    );

    Route::get('/user/edit/{id}',
        [
            'uses' => 'Admin\UserController@edit',
            'as'   => 'editUserForm'
        ]

    );

    Route::post('/user/edit',
        [
            'uses' => 'Admin\UserController@update',
            'as'   => 'editUser'
        ]

    );




    //Roles
    Route::get('/roles',
        [
            'uses' => 'Admin\RoleController@index',
            'as'   => 'showAllRoles'
        ]
    );

    Route::get('/roles/{id}',
        [
            'uses' => 'Admin\RoleController@delete',
            'as'   => 'deleteRole'
        ]
    );
    Route::get('/role/create',
        [
            'uses' => 'Admin\RoleController@create',
            'as'   => 'createRoleForm'
        ]
    );
    Route::post('/role/create',
        [
            'uses' => 'Admin\RoleController@store',
            'as'   => 'createRole'
        ]
    );

    Route::get('/role/edit/{id}',
        [
            'uses' => 'Admin\RoleController@edit',
            'as'   => 'editRoleForm'
        ]
    );

    Route::post('/role/edit',
        [
            'uses' => 'Admin\RoleController@update',
            'as'   => 'editRole'
        ]
    );





    //Gallery
    Route::get('/gallery',
       [
           'uses' => 'Admin\GalleryController@index',
           'as'   => 'showGallery'
       ]
    );

    Route::get('/gallery/create',
        [
            'uses' => 'Admin\GalleryController@create',
            'as'   => 'createImageForm'
        ]
    );

    Route::post('/gallery/create',
        [
            'uses' => 'Admin\GalleryController@store',
            'as'   => 'createImage'
        ]
    );
    Route::get('/gallery/edit/{id}',
        [
            'uses' => 'Admin\GalleryController@edit',
            'as'   => 'editImageForm'
        ]
    );
    Route::post('/gallery/edit',
        [
            'uses' => 'Admin\GalleryController@update',
            'as'   => 'editImage'
        ]
    );


   Route::get('/gallery/{id}',
       [
           'uses' => 'Admin\GalleryController@delete',
           'as'   => 'deleteImage'
       ]
   );







   //Comments
    Route::get('/comments',
       [
           'uses' => 'Admin\CommentController@index',
           'as'   => 'showComments'
       ]
    );

    Route::get('/comment/create',
        [
            'uses' => 'Admin\CommentController@create',
            'as'   => 'createCommentForm'
        ]
    );
    Route::post('/comment/create',
        [
            'uses' => 'Admin\CommentController@store',
            'as'   => 'createComment'
        ]
    );
    Route::get('/comment/edit/{id}',
        [
            'uses' => 'Admin\CommentController@edit',
            'as'   => 'editCommentForm'
        ]
    );
    Route::post('/comment/edit',
        [
            'uses' => 'Admin\CommentController@update',
            'as'   => 'editComment'
        ]
    );

   Route::get('/comment/{id}',
       [
           'uses' => 'Admin\CommentController@delete',
           'as'   => 'deleteComment'
       ]
    );












    //Posts
    Route::get('/posts',
      [
          'uses' => 'Admin\PostController@index',
          'as'   => 'showPosts'
      ]
    );

    Route::get('/post/{id}',
      [
          'uses' => 'Admin\PostController@delete',
          'as'   => 'deletePost'
      ]
    );
    
});


