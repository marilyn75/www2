<?php

namespace App\Http\Class;

// 메뉴판관련 클래스

class MenuClass{

    public function __construct()
    {
        
    }

    public function getMenus(){
        $menu = [
            [
                'code'=>'1',
                'txt'=>'매물등록', 
                'link'=>'#',
            ],
            [
                'code'=>'2',
                'txt'=>'매물검색', 
                'link'=>'#',
            ],
            [
                'code'=>'3',
                'txt'=>'고객지원', 
                'link'=>'#',
                'submenu' => [
                    [
                        'code'=>'3_1',
                        'txt'=>'공지사항', 
                        'link'=>route('board',21),
                    ],
                    [
                        'code'=>'3_2',
                        'txt'=>'서식자료실', 
                        'link'=>'#',
                    ],
                    [
                        'code'=>'3_3',
                        'txt'=>'고객문의', 
                        'link'=>'#',
                    ],
                ]
            ],
            [
                'code'=>'4',
                'txt'=>'기타', 
                'link'=>'#',
                'submenu' => [
                    [
                        'code'=>'4_1',
                        'txt'=>'관리자모드', 
                        'link'=>route('admin'),
                        'target'=>'_blank'
                    ],
                    [
                        'code'=>'4_2',
                        'txt'=>'UI Elements', 
                        'link'=>'http://www2.gbbinc.co.kr/page-ui-element.html',
                        'target'=>'_blank'
                    ],
                    [
                        'code'=>'4_3',
                        'txt'=>'Flaticon Demo', 
                        'link'=>'http://www2.gbbinc.co.kr/fonts/font/flaticon.html',
                        'target'=>'_blank'
                    ],
                ]
            ],
        ];

        return $menu;
    }
}