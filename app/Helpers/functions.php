<?php

if (!function_exists('showProfileImage')) {
    function showProfileImage()
    {
        if(!auth()->check()) return null;

        if (auth()->user()->file) {
            if(strpos(auth()->user()->file,'http')!==false)
                return auth()->user()->file;
            else
                return asset('/files/profile/' . auth()->user()->file);
        } else {
            $socialAccount = auth()->user()->socialAccounts()->first();
            if(!empty($socialAccount)){
                return $socialAccount->avatar;
            }else{
                return asset('/images/user-placeholder.png');
            }
        }
    }
}

// byte 표기
if (!function_exists('formatBytes')) {
    function formatBytes($bytes, $precision = 2) {
        $units = ["B", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB"];

        $bytes = max($bytes, 0);
        $power = floor(($bytes ? log($bytes) : 0) / log(1024));
        $power = min($power, count($units) - 1);

        // 바이트 값을 선택된 단위로 변환
        $bytes /= (1 << (10 * $power));

        // 지정된 소수 자릿수로 반올림
        $formatted = round($bytes, $precision);

        // 변환된 값과 단위를 문자열로 반환
        return $formatted . ' ' . $units[$power];
    }
}

// 파일 아이콘
if (!function_exists('fileIcon')) {
    function fileIcon($filename){
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        switch($extension){
            case 'hwp':
            case 'hwpx':
                $icon_file = 'hwp.gif';
                break;
            case 'jpg':
            case 'jpeg':
            case 'gif':
            case 'png':
            case 'jfif':
            case 'bmp':
                $icon_file = 'img.gif';
                break;
            case 'pdf':
                $icon_file = 'pdf.gif';
                break;
            case 'ppt':
            case 'pptx':
                $icon_file = 'ppt.gif';
                break;
            case 'txt':
                $icon_file = 'txt.gif';
                break;
            case 'mp4':
            case 'avi':
            case 'wmv':
            case 'mpg':
            case 'mpeg':
            case 'mkv':
            case 'mov':
                $icon_file = 'vod.gif';
                break;
            case 'mp3':
            case 'wav':
            case 'wma':
            case 'flac':
                $icon_file = 'wav.gif';
                break;
            case 'doc':
            case 'docx':
                $icon_file = 'word.gif';
                break;
            case 'xls':
            case 'xlsx':
            case 'csv':
                $icon_file = 'xls.gif';
                break;
            case 'zip':
            case 'apk':
            case 'rar':
            case '7z':
                $icon_file = 'zip.gif';
                break;
            default:
                $icon_file = 'default.gif';
                break;
        }

        return "/images/Common/ficon/" . $icon_file;
    }
}

// 날짜형식
if (!function_exists('formatCreatedAt')) {
    function formatCreatedAt($created_at) {
        // 입력된 created_at 문자열을 날짜 객체로 변환
        $date = new DateTime($created_at);
    
        // 현재 시간을 구합니다
        $now = new DateTime();
    
        // 날짜 차이 계산
        $interval = $now->diff($date);
    
        // 오늘, 어제, 또는 날짜 형식에 따라 출력
        if ($interval->d == 0) {
            return '오늘, ' . $date->format('H:i');
        } elseif ($interval->d == 1) {
            return '어제, ' . $date->format('H:i');
        } else {
            return $date->format('Y.m.d H:i');
        }
    }
}

// 날짜형식2
if (!function_exists('formatCreatedAt2')) {
    function formatCreatedAt2($created_at, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($created_at);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => '년',
            'm' => '개월',
            'w' => '주',
            'd' => '일',
            'h' => '시간',
            'i' => '분',
            's' => '초',
        );

        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' 전' : '방금 전';
    }
}

// 날짜형식3
if (!function_exists('printDateKor')) {
    function printDateKor($date) {
        $ymd = substr($date,0,10);
        $etc = substr($date,10);

        $dt = str_replace('.','-',$ymd);

        $arr = explode('-',$dt);

        return $arr[0] . '년 ' . $arr[1] . '월 ' . $arr[2] . '일'.$etc;
    }
}

// 날짜형식4
if (!function_exists('printDate')) {
    function printDate($date, $a='-') {
        $date = str_replace(['.','-'],'',$date);
        $y = substr($date,0,4);
        $m = substr($date,4,2);
        $d = substr($date,6);
        
        return $y . $a . $m . $a . $d;
    }
}

// select option 만들기
if (!function_exists('makeOptions')) {
    function makeOptions($cate, $id = null) {
        if(!is_array($cate)) return null;
        $html = "";
        foreach($cate as $_ct){
            $s = "";
            if($id==$_ct['id']) $s = "selected";
            $html .= '<option value="'.$_ct['id'].'" '.$s.'>'.$_ct['title'].'</option>';
        }

        return $html;
    }
}

// 값이 없을때 대체 문자
if (!function_exists('printEmpty')) {
    function printEmpty($val, $str='-'){
        if(empty($val))  return $str;
        else    return $val;
    }
}

// 숫자 한글로
if (!function_exists('price_kor')) {
    function price_kor($num){
        $result = '';

        $eok = floor($num / 100000000);
        if ($eok > 0) {
            $result .= $eok . '억 ';
            $num %= 100000000;
        }

        $man = floor($num / 10000);
        if ($man > 0) {
            $result .= $man . '만 ';
            $num %= 10000;
        }

        if ($num > 0) {
            $result .= $num;
        }

        return trim($result);
    }
}

// d-day 계산
if (!function_exists('calculateDDay')) {
    function calculateDDay($date) {
        $now = new DateTime(); // 현재 날짜와 시간
        $targetDate = new DateTime($date); // 목표 날짜

        $interval = $now->diff($targetDate); // 두 날짜 사이의 차이를 계산

        // D-Day 표시
        if ($now < $targetDate) {
            // 목표 날짜가 미래에 있는 경우
            return 'D-' . $interval->days+1;
        }if($interval->days==0){
            // 오늘이 목표 날짜인 경우
            return 'D-Day';
        } else {
            // 목표 날짜가 과거에 있는 경우
            return 'D+' . $interval->days;
        }
    }
}