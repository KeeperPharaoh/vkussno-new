<?php

return [
    'user'      => [
        'fields'      => [
            'name'              => [
                'type'       => 'string',
                'nullable'   => false,
                'unique'     => false,
                'fillable'   => true,
                'faker'      => [true, 'name()'],
                'validation' => [
                    'create' => [
                        'string'   => 'true',
                        'required' => 'true',
                    ],
                    'update' => [
                        'string' => 'true',
                    ],
                    'get'    => [

                    ],
                ],
            ],
            'email'             => [
                'type'       => 'string',
                'nullable'   => false,
                'unique'     => true,
                'fillable'   => true,
                'faker'      => [true, 'email()'],
                'validation' => [
                    'create' => [
                        'string'   => 'true',
                        'email'    => 'email:rfc,dns',
                        'required' => 'true',
                    ],
                    'update' => [
                        'string' => 'true',
                        'email'  => 'email:rfc,dns',
                    ],
                    'get'    => [

                    ],
                ],
            ],
            'email_verified_at' => [
                'type'       => 'string',
                'nullable'   => true,
                'unique'     => false,
                'fillable'   => true,
                'faker'      => [true, 'unixTime()'],
                'validation' => [
                    'create' => [

                    ],
                    'update' => [

                    ],
                    'get'    => [

                    ],
                ],
            ],
            'phone'             => [
                'type'       => 'string',
                'nullable'   => false,
                'unique'     => true,
                'fillable'   => true,
                'faker'      => [true, 'phoneNumber'],
                'validation' => [
                    'create' => [
                        'string'   => 'true',
                        'required' => 'true',
                    ],
                    'update' => [
                        'string' => 'true',
                    ],
                    'get'    => [

                    ],
                ],
            ],
            'password'          => [
                'type'       => 'string',
                'nullable'   => true,
                'unique'     => false,
                'fillable'   => true,
                'faker'      => [false, '\\Illuminate\\Support\\Facades\\Hash::make(\'123456\')'],
                'validation' => [
                    'create' => [
                        'string'   => 'true',
                        'password' => ['required', 'confirmed', 'Illuminate\Validation\Rules\Password::min(6)'],
                        'required' => 'true',
                    ],
                    'update' => [
                        'string'   => 'true',
                        'password' => ['required', 'confirmed', 'Illuminate\Validation\Rules\Password::min(6)'],
                    ],
                    'get'    => [

                    ],
                ],
            ],
            'remember_token'    => [
                'type'       => 'string',
                'nullable'   => true,
                'unique'     => false,
                'fillable'   => false,
                'faker'      => [false, 'null'],
                'validation' => [
                    'create' => [

                    ],
                    'update' => [

                    ],
                    'get'    => [

                    ],
                ],
            ],
            'subscription'      => [
                'type'       => 'bool',
                'nullable'   => false,
                'unique'     => false,
                'fillable'   => true,
                'faker'      => [true, '1'],
                'validation' => [
                    'create' => [
                        'required' => 'true'
                    ],
                    'update' => [
                        'bool' => 'true'
                    ],
                    'get'    => [

                    ]
                ]
            ],
            'city'              => [
                    'type'       => 'string',
                    'nullable'   => false,
                    'unique'     => false,
                    'fillable'   => true,
                    'faker'      => [true, 'city()'],
                    'validation' => [
                        'create' => [
                            'string'   => 'true',
                            'required' => 'true',
                        ],
                        'update' => [
                            'string' => 'true',
                        ],
                        'get'    => [

                        ],
                    ],
                ],
            'language'              => [
                'type'       => 'string',
                'nullable'   => false,
                'unique'     => false,
                'fillable'   => true,
                'faker'      => [true, 'language()'],
                'validation' => [
                    'create' => [
                        'string'   => 'true',
                        'required' => 'true',
                    ],
                    'update' => [
                        'string' => 'true',
                    ],
                    'get'    => [

                    ],
                ],
            ],

        ],
        'requests'    => [
            'create' => [
                'auth' => true,
            ],
            'update' => [
                'auth' => true,
            ],
            'get'    => [
                'auth' => false,
            ],
        ],
        'softDeletes' => true,
        'pageLength'  => 16,
    ],
    'category'  => [
        'fields' => [
            'title' => [
                'type'       => 'string',
                'nullable'   => false,
                'unique'     => false,
                'fillable'   => true,
                'faker'      => [true, 'title()'],
                'validation' => [
                    'create' => [
                        'string'   => 'true',
                        'required' => 'true',
                    ],
                    'update' => [
                        'string' => 'true',
                    ],
                    'get'    => [

                    ],
                ],
            ],
            'image' => [
                'type'       => 'string',
                'nullable'   => false,
                'unique'     => false,
                'fillable'   => true,
                'faker'      => [true, 'imageUrl(640, 480)'],
                'validation' => [
                    'create' => [
                        'string'   => 'true',
                        'required' => 'true',
                    ],
                    'update' => [
                        'string' => 'true',
                    ],
                    'get'    => [

                    ],
                ],
            ],
        ],
        'requests'    => [
            'create' => [
                'auth' => true,
            ],
            'update' => [
                'auth' => true,
            ],
            'get'    => [
                'auth' => false,
            ],
        ],
        'softDeletes' => true,
        'pageLength'  => 16,
    ],
    'product'   => [
        'fields' => [
            'subcategory_id' => [
                'type'       => 'unsignedBigInteger',
                'nullable'   => true,
                'unique'     => false,
                'fillable'   => true,
                'faker'      => [false, '\\App\\Models\\SubCategory::inRandomOrder()->first() ? \\App\\Models\\SubCategory::inRandomOrder()->first()->id : null'],
                'validation' => [
                    'create' => [
                        'integer'   => 'true',
                    ],
                    'update' => [
                        'integer' => 'true',
                    ],
                    'get'    => [

                    ],
                ],
            ],
            'title' => [
                'type'       => 'string',
                'nullable'   => false,
                'unique'     => false,
                'fillable'   => true,
                'faker'      => [true, 'title()'],
                'validation' => [
                    'create' => [
                        'string'   => 'true',
                        'required' => 'true',
                    ],
                    'update' => [
                        'string' => 'true',
                    ],
                    'get'    => [

                    ],
                ],
            ],
            'image' => [
                'type'       => 'string',
                'nullable'   => false,
                'unique'     => false,
                'fillable'   => true,
                'faker'      => [true, 'imageUrl(640, 480)'],
                'validation' => [
                    'create' => [
                        'string'   => 'true',
                        'required' => 'true',
                    ],
                    'update' => [
                        'string' => 'true',
                    ],
                    'get'    => [

                    ],
                ],
            ],
            'description'  => [
                'type'       => 'text',
                'nullable'   => false,
                'unique'     => false,
                'fillable'   => true,
                'faker'      => [true, 'text'],
                'validation' => [
                    'create' => [
                        'string'   => 'true',
                        'required' => 'true',
                    ],
                    'update' => [
                        'string' => 'true',
                    ],
                    'get'    => [

                    ],
                ],
            ],
            'price' => [
                'type'      =>  'integer',
                'nullable'  =>  false,
                'unique'     => false,
                'fillable'   => true,
                'faker'      => [false, 'integer'],
                'validation' => [
                    'create' => [
                        'string'   => 'true',
                        'required' => 'true',
                    ],
                    'update' => [
                        'string' => 'true',
                    ],
                    'get'    => [

                    ],
                ],
            ]
        ],
        'requests'    => [
            'create' => [
                'auth' => true,
            ],
            'update' => [
                'auth' => true,
            ],
            'get'    => [
                'auth' => false,
            ],
        ],
        'softDeletes' => true,
        'pageLength'  => 16,
    ],
];
