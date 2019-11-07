<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | The default title of your admin panel, this goes into the title tag
    | of your page. You can override it per page with the title section.
    | You can optionally also specify a title prefix and/or postfix.
    |
    */

    'title' => 'Wananchi HR Recruitment',

    'title_prefix' => '',

    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | This logo is displayed at the upper left corner of your admin panel.
    | You can use basic HTML here if you want. The logo has also a mini
    | variant, used for the mini side bar. Make it 3 letters or so
    |
    */

    'logo' => '<b>Wananchi</b> Recruitment',

    'logo_mini' => '<b>HR</b>R',

    /*
    |--------------------------------------------------------------------------
    | Skin Color
    |--------------------------------------------------------------------------
    |
    | Choose a skin color for your admin panel. The available skin colors:
    | blue, black, purple, yellow, red, and green. Each skin also has a
    | light variant: blue-light, purple-light, purple-light, etc.
    |
    */

    'skin' => 'green',

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Choose a layout for your admin panel. The available layout options:
    | null, 'boxed', 'fixed', 'top-nav'. null is the default, top-nav
    | removes the sidebar and places your menu in the top navbar
    |
    */

    'layout' => null,

    /*
    |--------------------------------------------------------------------------
    | Collapse Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we choose and option to be able to start with a collapsed side
    | bar. To adjust your sidebar layout simply set this  either true
    | this is compatible with layouts except top-nav layout option
    |
    */

    'collapse_sidebar' => false,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we have the option to enable a right sidebar.
    | When active, you can use @section('right-sidebar')
    | The icon you configured will be displayed at the end of the top menu,
    | and will show/hide de sidebar.
    | The slide option will slide the sidebar over the content, while false
    | will push the content, and have no animation.
    | You can also choose the sidebar theme (dark or light).
    | The right Sidebar can only be used if layout is not top-nav.
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Register here your dashboard, logout, login and register URLs. The
    | logout URL automatically sends a POST request in Laravel 5.3 or higher.
    | You can set the request to a GET or POST with logout_method.
    | Set register_url to null if you don't want a register link.
    |
    */

    'dashboard_url' => 'home',

    'logout_url' => 'logout',

    'logout_method' => null,

    'login_url' => 'login',

    'register_url' => 'register',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Specify your menu items to display in the left sidebar. Each menu item
    | should have a text and a URL. You can also specify an icon from Font
    | Awesome. A string instead of an array represents a header in sidebar
    | layout. The 'can' is a filter on Laravel's built in Gate functionality.
    */

    'menu' => [
        [
            'text' => 'Dashboard',
            'url'  => 'home',
            'icon' => 'fas fa-fw fa-home',
            'icon_color' => 'blue',
        ],

        [
            'text'    => 'Job Postings',
            'icon'    => 'fas fa-fw fa-tags',
            'icon_color' => 'warning',
            'submenu' => [
                [
                    'text' => 'All Job Postings',
                    'url'  => 'jobs/postings',
                    'icon' => 'fas fa-fw fa-plus-circle',
                    'icon_color' => 'purple'
                ],
                [
                    'text' => 'Open Job Postings',
                    'url'  => 'jobs/open',
                    'icon' => 'fas fa-fw fa-exclamation',
                    'icon_color' => 'aqua'
                ],
                [
                    'text' => 'Ongoing Job Postings',
                    'url'  => 'jobs/ongoing',
                    'icon' => 'fas fa-fw fa-exclamation',
                    'icon_color' => 'blue'
                ],
                [
                    'text' => 'Closed Job Postings',
                    'url'  => 'jobs/closed',
                    'icon' => 'fas fa-fw fa-briefcase',
                    'icon_color' => 'green'
                ],
                [
                    'text' => 'Deleted Job Postings',
                    'url'  => 'jobs/deleted',
                    'icon' => 'fas fa-fw fa-trash',
                    'icon_color' => 'red'
                ],
            ],
        ],
        [
            'text'    => 'Job Interviews',
            'icon'    => 'fas fa-fw fa-desktop',
            'icon_color' => 'danger',
            'submenu' => [
                [
                    'text' => 'All Job Interviews',
                    'url'  => 'jobs/interviews',
                    'icon' => 'fas fa-fw fa-list',
                    'icon_color' => 'green'
                ],
                [
                    'text' => 'Open Interviews',
                    'url'  => 'interviews/open',
                    'icon' => 'fas fa-fw fa-exclamation',
                    'icon_color' => 'aqua'
                ],
                [
                    'text' => 'Ongoing Interviews',
                    'url'  => 'interviews/ongoing',
                    'icon' => 'fas fa-fw fa-exclamation',
                    'icon_color' => 'blue'
                ],
                [
                    'text' => 'Closed Interviews',
                    'url'  => 'interviews/closed',
                    'icon' => 'fas fa-fw fa-briefcase',
                    'icon_color' => 'red'
                ],
                [
                    'text' => 'Senior Management Interviews',
                    'url'  => 'interviews/senior',
                    'icon' => 'fas fa-fw fa-certificate',
                    'icon_color' => 'yellow'
                ],
                [
                    'text' => 'Staff Member Interviews',
                    'url'  => 'interviews/staff',
                    'icon' => 'fas fa-fw fa-map',
                    'icon_color' => 'purple'
                ],
                [
                    'text' => 'Deleted Interviews',
                    'url'  => 'interviews/deleted',
                    'icon' => 'fas fa-fw fa-trash',
                    'icon_color' => 'red'
                ],
            ],
        ],
        [
            'text'    => 'Exit Interviews',
            'icon'    => 'fas fa-fw fa-arrow-circle-left',
            'icon_color' => 'aqua',
            'submenu' => [
                [
                    'text' => 'All Exit Interviews',
                    'url'  => 'exit_interviews',
                    'icon' => 'fas fa-fw fa-plus-circle',
                    'icon_color' => 'purple'
                ],
                [
                    'text' => 'Deleted Exit Interviews',
                    'url'  => 'exit_interview/deleted',
                    'icon' => 'fas fa-fw fa-trash',
                    'icon_color' => 'danger'
                ],
            ],
        ],
        [
            'text' => 'Departments',
            'url'  => 'departments',
            'icon' => 'fas fa-fw fa-laptop',
            'icon_color' => 'blue',
            'can' => 'departments.view',
        ],
        [
            'text'    => 'Reports',
            'icon'    => 'fas fa-fw fa-barcode',
            'icon_color' => 'purple',
            'submenu' => [
                [
                    'text' => 'Job Postings',
                    'url'  => 'reports/jobs',
                    'icon'    => 'fas fa-fw fa-list-alt',
                    'icon_color' => 'purple'
                ],
                [
                    'text' => 'Job Interviews',
                    'url'  => 'reports/interviews',
                    'icon' => 'fas fa-fw fa-th-list',
                    'icon_color' => 'green'
                ],
                [
                    'text' => 'Exit Interviews',
                    'url'  => 'reports/exit_interviews',
                    'icon' => 'fas fa-fw fa-list-ul',
                    'icon_color' => 'aqua'
                ],
                [
                    'text' => 'Candidates Report',
                    'icon' => 'fas fa-fw fa-users',
                    'icon_color' => 'blue',
                    'submenu'  => [
                        [
                            'text' => 'Added Candidates',
                            'url'  => 'reports/candidates/added',
                            'icon' => 'fas fa-fw fa-users',
                            'icon_color' => 'yellow'
                        ],
                        [
                            'text' => 'Rated Candidates',
                            'url'  => 'reports/candidates/rated',
                            'icon' => 'fas fa-fw fa-users',
                            'icon_color' => 'purple'
                        ],
                        [
                            'text' => 'Selected Candidates',
                            'url'  => 'reports/candidates/selected',
                            'icon' => 'fas fa-fw fa-users',
                            'icon_color' => 'green'
                        ],
                    ],
                ],
                [
                    'text' => 'Panelists Report',
                    'url'  => 'reports/panelists',
                    'icon' => 'fas fa-fw fa-users',
                    'icon_color' => 'red'
                ],
            ],
        ],
        [
            'text'    => 'User Management',
            'url' => 'users',
            'icon'    => 'fas fa-fw fa-user-circle',
            'icon_color' => 'green',
            'can' => 'departments.view',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Choose what filters you want to include for rendering the menu.
    | You can add your own filters to this array after you've created them.
    | You can comment out the GateFilter if you don't want to use Laravel's
    | built in Gate functionality
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Configure which JavaScript plugins should be included. At this moment,
    | DataTables, Select2, Chartjs and SweetAlert are added out-of-the-box,
    | including the Javascript and CSS files from a CDN via script and link tag.
    | Plugin Name, active status and files array (even empty) are required.
    | Files, when added, need to have type (js or css), asset (true or false) and location (string).
    | When asset is set to true, the location will be output using asset() function.
    |
    */

    'plugins' => [
        [
            'name' => 'Datatables',
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.css',
                ],
            ],
        ],
        [
            'name' => 'Select2',
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        [
            'name' => 'Chartjs',
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        [
            'name' => 'Sweetalert2',
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        [
            'name' => 'Pace',
            'active' => true,
            'color' => 'white',
            'type' => 'minimal',
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-minimal.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],
];