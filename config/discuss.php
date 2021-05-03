<?php

return [
    'categories'=>[
        'model'=>Aankhijhyaal\Discuss\Models\Category::class,
        'table_name'=>'discuss_categories',
        'parent_key'=>'discuss_category_id'
    ],

    'threads'=>[
        'model'=>Aankhijhyaal\Discuss\Models\Thread::class,
        'table_name'=>'discuss_threads',
        'category_key'=>'discuss_category_id',
        'user_morph_key'=>'discussant',
        'allow_update'=>true,
        'allow_close'=>true,
        'allow_reopen'=>true,
        'allow_delete'=>true
    ],

    'replies'=>[
        'model'=>Aankhijhyaal\Discuss\Models\Reply::class,
        'table_name'=>'discuss_replies',
        'thread_key'=>'discuss_thread_id',
        'parent_reply_key'=>'discuss_reply_id',
        'user_morph_key'=>'discussant',
        'allow_update'=>true,
        'allow_delete'=>true
    ],

    'anonymous'=>[
        'thread'=>false,
        'reply'=>false
    ],


    'pages'=>[
        'extends'=>'layouts.app'
    ],

    'routes'=>[
        'home'       => 'discussions',
        'thread_view' => 'discuss',
        'category'   => 'category',
        'post'       => 'posts',
    ]
];
